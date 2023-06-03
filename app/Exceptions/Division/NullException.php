<?php

declare(strict_types=1);

namespace App\Exceptions\Division;

use Exception;
use Illuminate\Http\RedirectResponse;
use Throwable;

class NullException extends Exception
{
    /**
     * @var string
     */
    public $message;

    /**
     * GoogleException constructor.
     *
     * @param string|int|null $number1
     * @param string|int|null $number2
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        private readonly string|int|null $number1,
        private readonly string|int|null $number2,
        string $message,
        int $code = 0,
        Throwable|null $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
        $this->message = $message;
    }

    /**
     * Report the exception.
     *
     * @return bool
     */
    public function report(): bool
    {
        return false;
    }

    /**
     * @return array
     */
    public function context(): array
    {
        return [
            'number1' => $this->number1,
            'number2' => $this->number2,
        ];
    }

    /**
     * Render the exception on HTTP response.
     *
     * @return RedirectResponse
     */
    public function render(): RedirectResponse
    {
        $class = get_class($this);

        return redirect()->route('division')->with([
            'message' => $this->message,
            'exception' => $class,
        ]);
    }
}
