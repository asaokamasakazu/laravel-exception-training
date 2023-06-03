<?php

declare(strict_types=1);

namespace App\Http\Controllers\Division;

use App\Exceptions\Division\NullException;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use TypeError;

class DivisionController extends Controller
{
    /**
     * 割り算画面を表示する
     *
     * @return View
     */
    public function index(): View
    {
        return view('Division.index');
    }

    /**
     * 割り算の計算を行う
     *
     * @param Request $request
     *
     * @throws NullException
     *
     * @return View|RedirectResponse
     */
    public function calculate(Request $request): View|RedirectResponse
    {
        $number1 = $request->input('number1');
        $number2 = $request->input('number2');

        // 独自例外の使用例
        if (! $number1 || ! $number2) {
            throw new NullException($number1, $number2, __('exception.division.null_exception'));
        }

        // try-catchの使用例
        try {
            $result = $number1 / $number2;
        } catch (TypeError $e) {
            $msg = __('message.division.un_number');
            $caughtClass = TypeError::class;

            Log::error($msg, [
                'method' => __METHOD__,
                'number1' => $number1,
                'number2' => $number2,
                'error' => $e,
            ]);

            return redirect()->route('division')->with([
                'message' => $msg,
                'exception' => $caughtClass,
            ]);
        }

        return view('Division.index', compact('result'));
    }
}
