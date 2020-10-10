<div>
    <h2>
        Новый заказ!
    </h2>
    <table>
        <tr>
            <td>
                {{ __('Имя клиента') }} : {{ $order['owner_name'] }}
            </td>
        </tr>
        <tr>
            <td>
                {{ __('Время') }} : {{ $order['working_diapason']['time_start'] }}
            </td>
        </tr>
        <tr>
            <td>
                {{ __('Телефон') }} : {{ $order['phone'] }}
            </td>
        </tr>
        <tr>
            <td>
                {{ __('Питомец') }} : {{ $order['pet_name'] }}
            </td>
        </tr>
        <tr>
            <td>
                {{ __('Электронная почта') }} : {{ $order['email'] }}
            </td>
        </tr>
        <tr>
            <td>
                {{ __('Комментарий') }} : {{ $order['comment'] }}
            </td>
        </tr>
    </table>
</div>
