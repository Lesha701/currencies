<?php

namespace App\Console\Commands;

use App\Repositories\CurrencyRepository;
use App\Services\HtmlCurrencyParser;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ParseAllCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:parse:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse all currencies from CBR';

    /**
     * @var CurrencyRepository
     */
    private $repository;

    /**
     * Create a new command instance.
     *
     * @param CurrencyRepository $repository
     */
    public function __construct(CurrencyRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    /**
     * Execute the console command.
     *
     * @param HtmlCurrencyParser $parser
     * @return int
     */
    public function handle(HtmlCurrencyParser $parser)
    {
        $date = Carbon::createFromFormat('d.m.Y', '15.10.2020');

        while (!$date->isCurrentDay()) {
            $this->info('Parse currencies at ' . $date->format('d.m.Y'));

            $this->saveDataToDB(
                $parser->parse($date->format('d.m.Y')),
                $date->format('Y-m-d')
            );

            $this->info('Data saved in DB!');

            $date->addDay();

            $this->info('Go to next date...');
        }

        $this->info('Currency parsing finished');

        return 0;
    }

    /**
     * @param array $data
     * @param string $date
     */
    private function saveDataToDB(array $data, string $date): void
    {
        foreach ($data['currencies'] as $currency) {
            $this->repository->save($date, $currency);
        }
    }
}
