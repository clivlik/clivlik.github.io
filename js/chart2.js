function test(){
    console.log(document.getElementById("plan").value);
    d3.json("php/getplan.php", function(data) {
    console.log(data)
    data = data*100/(document.getElementById("plan").value);
    var chart = c3.generate({
        data: {
            columns: [
                ['Процент выполнения плана', data]
            ],
            type: 'gauge',
            onclick: function (d, i) {
                console.log("onclick", d, i);
            },
            onmouseover: function (d, i) {
                console.log("onmouseover", d, i);
            },
            onmouseout: function (d, i) {
                console.log("onmouseout", d, i);
            }
        },
        gauge: {},
        color: {
            pattern: ['#80110b', '#80110b', '#80110b', '#80110b'], // the three color levels for the percentage values.
            threshold: {
                unit: 'value',
                max: 50000,
                values: [30, 60, 90, 100]
            }
        },
        size: {
            height: 256
        },
        bindto: '#chart2'
    });
});
}