$(document).ready(function(){
    
    var url = "http://localhost:8080/PicServer/ListSpace";
    var uid = $('#uid').html();

    var color = ["#1ab394","#79d2c0","#d3d3d3"];
    console.log(color);
    $.getJSON(url, { uid: uid }, function(json){
        var spaces = json.Spaces;
        var tot_size = 0;
        
        $.each(spaces, function(i,val){      
            tot_size += parseFloat(val.storage);
        });
        var data = new Array();
        $.each(spaces, function(i,val){ 
            console.log(color[i]);
            var v = {
                label: val.name,
                data: Math.round(val.storage / tot_size * 100),
                color: color[i]
            };
            console.log(v);
            data.push(v);
        });
        // console.log(tot_size);
        // console.log(data);
        // console.log(spaces);

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

    //Flot Pie Chart
    // var data = [{
    //     label: "空间1",
    //     data: 21,
    //     color: "#1ab394",
    // },{
    //     label: "空间2",
    //     data: 15,
    //     color: "#79d2c0",
    // }, {
    //     label: "未使用",
    //     data: 52,
    //     color: "#d3d3d3",
    // }];
        


});