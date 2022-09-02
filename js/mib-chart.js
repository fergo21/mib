exampleData();
$("#desde, #hasta").change(function(){
  exampleData();
});
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
          values: response
        }];
        nv.addGraph(function() {
          var chart = nv.models.discreteBarChart()
              .x(function(d) { return d.label })    //Specify the data accessors.
              .y(function(d) { return d.value })
              .staggerLabels(true)    //Too many bars and not enough room? Try staggering labels.
              // .tooltips(false)        //Don't show tooltips
              // .showValues(true)       //...instead, show the bar value right on top of each bar.
              // .transitionDuration(350)
              ;

          d3.select('#chart svg')
              .datum(dataChart)
              .call(chart);

          nv.utils.windowResize(chart.update);

          return chart;
        });
      
        
      }).fail(function(jqXHR, textStatus, errorThrown){
        console.log(textStatus, errorThrown);
      })
}