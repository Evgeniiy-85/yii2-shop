<div class="card card-default">
    <div class="card-body overflow-x-auto" style="padding: 0">
        <table class="table text-nowrap">
            <thead>
                <tr>
                    <th>Наименование товара</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th>Итого</th>
                </tr>
            </thead>

            <tbody>
                <?foreach($products as $product):?>
                    <tr>
                        <td><?=$product->prod_title;?></td>
                        <td>1</td>
                        <td><?=$product->prod_price;?> руб.</td>
                        <td><?=$product->prod_price;?> руб.</td>
                    </tr>
                <?endforeach;?>
                <tr>
                    <td></td>
                    <td></td>
                    <td><strong>Сумма</strong></td>
                    <td><?=$product->prod_price;?> руб.</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><strong>Итого</strong></td>
                    <td><?=$product->prod_price;?> руб.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>