$(document).ready(function(){
    //Flot Pie Chart
    var data = [{
        label: "空间1",
        data: 21,
        color: "#1ab394",
    },{
        label: "空间2",
        data: 15,
        color: "#79d2c0",
    }, {
        label: "未使用",
        data: 52,
        color: "#d3d3d3",
    }];
        
        var plotObj = $.plot($("#flot-pie-chart"), data, {
            series: {
                pie: {
                    show: true,
                }
            },
            grid: {
                hoverable: true
            },

            tooltip: true,
            tooltipOpts: {
                content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                shifts: {
                    x: 20,
                    y: 0
                },
                defaultTheme: false
            }
        });

});