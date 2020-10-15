<?php

namespace App\Console\Commands;

use App\Repositories\CurrencyRepository;
use App\Services\HtmlCurrencyParser;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ParseDailyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:parse:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse today currencies from CBR';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param HtmlCurrencyParser $parser
     * @param CurrencyRepository $repository
     *
     * @return int
     */
    public function handle(HtmlCurrencyParser $parser, CurrencyRepository $repository)
    {
        $today = Carbon::now()->format('d.m.Y');

        $this->info('Parse today (' . $today . ') currencies');

        $data = $parser->parse($today);
        foreach ($data['currencies'] as $currency) {
            $repository->save($data['date'], $currency);
        }

        $this->info('Data saved in DB!');

        return 0;
    }
}
