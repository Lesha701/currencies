<?php

namespace App\Http\Controllers;

use App\DTO\Pagination;
use App\Formatters\CurrencyCollectionFormatter;
use App\Formatters\CurrencyFormatter;
use App\Repositories\CurrencyRepository;
use App\Response\ErrorResponse;
use App\Response\SuccessResponse;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * @var CurrencyRepository
     */
    private $currencyRepository;

    /**
     * CurrencyController constructor.
     * @param CurrencyRepository $currencyRepository
     */
    public function __construct(CurrencyRepository $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function index(): SuccessResponse
    {
        return new SuccessResponse([
            'info' => 'Currency API'
        ]);
    }

    public function list(Request $request): SuccessResponse
    {
        $pagination = (new Pagination())
            ->setPage($request->get(Pagination::PAGE_PARAM, Pagination::DEFAULT_PAGE))
            ->setLimit($request->get(Pagination::LIMIT_PARAM, Pagination::DEFAULT_LIMIT));

        $currencyCollection = $this->currencyRepository->get($pagination);

        return new SuccessResponse(
            (new CurrencyCollectionFormatter($currencyCollection))->format()
        );
    }

    /**
     * @param string $code
     * @param Request $request
     * @return JsonResponse
     */
    public function show(string $code, Request $request): JsonResponse
    {
        $date = Carbon::createFromFormat('d.m.Y', $request->get('date'));
        $currency = $this->currencyRepository->getByDateAndCode($date->format('Y-m-d'), $code);

        if ($currency === null) {
            return new ErrorResponse('Currency not found', 404);
        }

        return new SuccessResponse(
            (new CurrencyFormatter($currency))->format()
        );
    }
}
