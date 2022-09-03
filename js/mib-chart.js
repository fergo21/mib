exampleData();
$("#desde, #hasta").change(function(){
  exampleData();
});
function renderChart(data, elements){
  nv.addGraph(function() {
    var chart = nv.models.discreteBarChart()
        .x(function(d) { return d.label })    //Specify the data accessors.
        .y(function(d) { return d.value })
        .staggerLabels(true)    //Too many bars and not enough room? Try staggering labels.
        // .tooltips(false)        //Don't show tooltips
        // .showValues(true)       //...instead, show the bar value right on top of each bar.
        // .transitionDuration(350)
        ;

    d3.select(elements)
        .datum(data)
        .call(chart);

    nv.utils.windowResize(chart.update);

    return chart;
  });
}
//Each bar represents a single discrete quantity.
function exampleData() {
  let desde = $("#desde").val();
  let hasta = $("#hasta").val();
  $.ajax({
        url: `${homeUrl}/tickets/getcollection`,
        method: 'POST',
        data: { d: desde, h: hasta }
      }).done(function(data){
        let response = JSON.parse(data);
        let dataChart = [{
          key: "Chart",
          values: response.office
        }];
        let dataChartS = [{
          key: "ChartS",
          values: response.seller
        }];
  
      renderChart(dataChart, "#chart svg");
      renderChart(dataChartS, "#chartS svg");    
        
      }).fail(function(jqXHR, textStatus, errorThrown){
        console.log(textStatus, errorThrown);
      })
}