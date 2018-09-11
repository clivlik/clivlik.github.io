d3.json("php/getjson.php", function(data) {
    console.log(data);
    var chart1 = c3.generate({
        data: {
            json:
            data,
            keys: {
                value: ['amount'],
                x: 'order_number',
            },
            names: {
                amount: 'Сумма заказа',
            },
            type: 'spline'
        },
        axis: {
            x: {

                 label: 'Номер заказа',
                     type: 'category',
                   // categories: ['order_number'],
            },
            y: {
                label: 'Стоимость заказа'
            }
        },
        grid: {
            x: {
                show: true
            },
            y: {
                show: true
            }
        },
        color: {
            pattern: ['#80110b']
        },
        bindto: '#chart1'
    });
});
