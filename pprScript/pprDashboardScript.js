var getAjaxRequest = function (url, params) {
  var data = "";
  $.ajax({
    url: url,
    type: "POST",
    dataType: "json",
    data: params,
    async: false,
    success: function callback(response) {
      // console.log(response);
      // var data=JSON.parse(response);
      data = response;
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert("Error occurred!");
    },
  });
  return data;
};
var onloadFNs = function () {
  setFiltersDropDowns("DDDivision");
  $("#DDDivision")[0].selectedIndex = 0;
  setFiltersDropDowns("DDRegion");
  setFiltersDropDowns("DDSector");
  setFiltersDropDowns("DDMonths");
  // $("#DDMonths")[0].selectedIndex = 0;
  var mon = $("#DDMonths").val() + "-" + $("#DDYear").val();
  var did = $("#DDDivision").val();
  var isfx = $("#isFX").prop("checked") == true ? 1 : 0;
  // alert(isfx);
  var params = {
    devision: did,
    region: "%",
    country: "%",
    sector: "%",
    months: mon,
    isfx: isfx,
  };
  // console.log(params);
  setTableSummaryFn(params);
  loadChartFunctions(params);
};
var searchLoadFn = function () {
  var did = $("#DDDivision").val();
  var rgn = $("#DDRegion").val();
  var sec = $("#DDSector").val();
  var mon = $("#DDMonths").val() + "-" + $("#DDYear").val();
  var isfx = $("#isFX").prop("checked") == true ? 1 : 0;
  // alert(isfx);
  if (rgn.length == 0) {
    rgn = "%";
  }
  if (sec.length == 0) {
    sec = "%";
  }
  // console.log(rgn.toString());
  var params = {
    devision: did,
    region: rgn.toString(),
    country: "%",
    sector: sec.toString(),
    months: mon,
    isfx: isfx,
  };
  setTableSummaryFn(params);
  loadChartFunctions(params);
};
//load filters
var setFiltersDropDowns = function (ddid) {
  var paramJ = "";
  var did = $("#DDDivision").val();
  paramJ = { division: did, region: "%", ddfor: ddid };
  var response = getAjaxRequest("pprScript/server/setFilters.php", paramJ);
  var data = response;
  var resStatus = data[0]["msgstatus"];
  if (resStatus == "402") {
    alert("No Record Found");
    return;
  } else {
    // console.log(data);
    var sbox = document.getElementById(ddid);
    sbox.length = 0;
    // if (ddid == "DDMonths") {
    //   sbox.length = 0;
    // } else {
    //   sbox.length = 1;
    // }
    var months = [],
      years = [],
      res = [];
    for (var i = 0; i < data.length; i++) {
      if (ddid == "DDMonths") {
        res.push(data[i]["ddname"]);
      } else {
        sbox.add(new Option(data[i]["ddname"], data[i]["ddid"]));
      }
    }
    if (ddid == "DDMonths") {
      for (var i = 0; i < res.length; i++) {
        // var m = res[i].split("-")[0];
        var y = res[i].split("-")[1];
        // months.push(m);
        years.push(y);
      }
      // months = months.filter(function (itm, i, a) {
      //   return i == a.indexOf(itm);
      // });
      var month = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ];
      years = years
        .filter(function (itm, i, a) {
          return i == a.indexOf(itm);
        })
        .sort();
      for (var i = 0; i < month.length; i++) {
        sbox.add(new Option(month[i], i + 1));
      }
      var sboxy = document.getElementById("DDYear");
      sboxy.length = 0;
      for (var i = 0; i < years.length; i++) {
        sboxy.add(new Option(years[i], years[i]));
      }
      // setTimeout(function () {
      var text1 = res[0].split("-")[0];
      var year1 = res[0].split("-")[1];
      $("#DDMonths option:contains(" + text1 + ")").attr("selected", true);
      $("#DDYear option:contains(" + year1 + ")").attr("selected", true);
      // }, 2000);
    }
    if (ddid == "DDMonths" || ddid == "DDDivision") {
    } else {
      // console.log(ddid);
      $("#" + ddid).multiselect({
        columns: 1,
        placeholder: data[0]["ddlabel"],
        // search: true,
        selectAll: true,
      });
    }
  }
};
// load filters end

// top table
var getTableSummaryFunctions = function (paramJ) {
  var response = getAjaxRequest("pprScript/server/getDataTable.php", paramJ);
  var data = response;
  var resStatus = data[0]["msgstatus"];
  if (resStatus == "402") {
    alert("No Record Found");
    return "no";
  } else {
  }
  return data;
};
var setTableSummaryFn = function (params) {
  // var params = { devision: "1", region: "1", country: "2", sector: "1" };
  var res = getTableSummaryFunctions(params);
  if (res == "no") {
    return;
  }

  var data = res[0];
  // console.log(data.total_rev_mtd);
  // see table layout on web

  // column 2
  $("#actualmtd1").html(numberWithCommas(data.total_rev_mtd));
  $("#actualmtd2").html(numberWithCommas(data.total_fee_mtd));
  $("#actualmtd3").html(numberWithCommas(data.total_contrib_mtd));
  $("#actualmtd4").html(
    numberWithpercentage(data.total_contrib_mtd_percentage)
  );
  //parseFloat(data.divisional_overhead) +
  var c25 = parseFloat(data.country_overhead);
  $("#actualmtd5").html(numberWithCommas(c25));
  $("#actualmtd6").html(numberWithCommas(data.country_overhead));
  // parseFloat(data.divisional_overhead)
  // alert(parseFloat(data.country_overhead));
  var c28 =
    parseFloat(getNum(ifnullVal(data.total_contrib_mtd))) -
    parseFloat(getNum(ifnullVal(data.country_overhead)));
  $("#actualmtd61").html(numberWithCommas(c28.toFixed(2)));
  $("#actualmtd62").html(
    numberWithpercentage(
      (
        (parseFloat(ifnullVal(c28)) /
          parseFloat(ifnullVal(data.total_fee_mtd))) *
        100
      ).toFixed(2)
    )
  );
  $("#actualmtd7").html(numberWithCommas(data.divisional_overhead));
  $("#actualmtd71").html(numberWithCommas(data.divisional_overhead));
  var c718 =
    parseFloat(data.total_contrib_mtd) -
    (parseFloat(getNum(ifnullVal(data.divisional_overhead))) +
      parseFloat(getNum(ifnullVal(data.country_overhead))));
  $("#actualmtd72").html(numberWithCommas(c718.toFixed(2)));
  $("#actualmtd73").html(
    numberWithpercentage(
      (
        (parseFloat(ifnullVal(c718)) /
          parseFloat(ifnullVal(data.total_fee_mtd))) *
        100
      ).toFixed(2)
    )
  );

  // column 3
  $("#mtdforcast2").html(numberWithCommas(data.mtd_forcast_fee));
  $("#mtdforcast3").html(numberWithCommas(data.mtd_forcast_contrib));
  $("#mtdforcast4").html(numberWithpercentage(data.mtd_forcast_fee_percen));
  $("#mtdforcast8").html(numberWithCommas(data.mtd_forcast_contrib));
  $("#mtdforcast9").html(numberWithpercentage(data.mtd_forcast_fee_percen));

  // column 4
  $("#mtdbudget2").html(numberWithCommas(data.mtd_budget_fee));
  $("#mtdbudget3").html(numberWithCommas(data.mtd_budget_contrib));
  $("#mtdbudget4").html(
    numberWithpercentage(
      (
        (parseFloat(ifnullVal(data.mtd_budget_contrib)) /
          parseFloat(ifnullVal(data.mtd_budget_fee))) *
        100
      ).toFixed(2)
    )
  );
  var c45 = parseFloat(data.country_overhead_budget);
  $("#mtdbudget5").html(numberWithCommas(c45));
  $("#mtdbudget6").html(numberWithCommas(data.country_overhead_budget));
  var c48 =
    parseFloat(data.mtd_budget_contrib) -
    parseFloat(getNum(ifnullVal(data.country_overhead_budget)));
  $("#mtdbudget61").html(numberWithCommas(c48.toFixed(2)));
  $("#mtdbudget62").html(
    numberWithpercentage(
      (
        (parseFloat(ifnullVal(c48)) /
          parseFloat(ifnullVal(data.mtd_budget_fee))) *
        100
      ).toFixed(2)
    )
  );
  $("#mtdbudget7").html(numberWithCommas(data.divisional_overhead_budget));
  $("#mtdbudget71").html(numberWithCommas(data.divisional_overhead_budget));
  var c472 =
    parseFloat(data.mtd_budget_contrib) -
    (parseFloat(getNum(ifnullVal(data.divisional_overhead_budget))) +
      parseFloat(getNum(ifnullVal(data.country_overhead_budget))));
  $("#mtdbudget72").html(numberWithCommas(c472.toFixed(2)));
  $("#mtdbudget73").html(
    numberWithpercentage(
      (
        (parseFloat(ifnullVal(c472)) /
          parseFloat(ifnullVal(data.mtd_budget_fee))) *
        100
      ).toFixed(2)
    )
  );

  // column 5
  var c52 =
    parseFloat(ifnullVal(data.total_fee_mtd)) -
    parseFloat(ifnullVal(data.mtd_budget_fee));
  $("#mtdyartobudget2").html(numberWithCommas(c52.toFixed(2)));
  conditionalFormating("mtdyartobudget2", c52);

  var c53 =
    parseFloat(ifnullVal(data.total_contrib_mtd)) -
    parseFloat(ifnullVal(data.mtd_budget_contrib));
  $("#mtdyartobudget3").html(numberWithCommas(c53.toFixed(2)));
  conditionalFormating("mtdyartobudget3", c53);

  // $("#mtdyartobudget4").html(numberWithCommas(0));

  $("#mtdyartobudget5").html(numberWithCommas(c25 - c45));
  conditionalFormatingOH("mtdyartobudget5", c25 - c45);

  // $("#mtdyartobudget7").html(numberWithCommas(c718 - c472));
  var c57 =
    parseFloat(ifnullVal(data.divisional_overhead)) -
    parseFloat(ifnullVal(data.divisional_overhead_budget));
  $("#mtdyartobudget7").html(numberWithCommas(c57.toFixed(2)));
  conditionalFormatingOH("mtdyartobudget7", c57);
  // $("#mtdyartobudget9").html(numberWithCommas(0));

  // column 6
  var c62 =
    (ifnullVal(data.total_fee_mtd) /
      parseFloat(ifnullVal(data.mtd_budget_fee))) *
    100;
  c62 = isFinite(c62) ? c62 : 0;
  $("#mtdinpercenofbudget2").html(numberWithpercentage(c62.toFixed(2)));
  conditionalFormatingpercentage("mtdinpercenofbudget2", c62);
  var c63 =
    (ifnullVal(data.total_contrib_mtd) /
      parseFloat(ifnullVal(data.mtd_budget_contrib))) *
    100;
  c63 = isFinite(c63) ? c63 : 0;
  $("#mtdinpercenofbudget3").html(numberWithpercentage(c63.toFixed(2)));
  conditionalFormatingpercentage("mtdinpercenofbudget3", c63);

  // $("#mtdinpercenofbudget4").html(numberWithCommas(0));
  // $("#mtdinpercenofbudget8").html(
  //   numberWithCommas(ifnullVal(data.net_mtd_contribution) - ifnullVal(0))
  // );
  // $("#mtdinpercenofbudget9").html(numberWithCommas(0));

  // column 7
  $("#actualytd1").html(numberWithCommas(data.total_rev1_ytd));
  $("#actualytd2").html(numberWithCommas(data.total_fee_ytd));
  $("#actualytd3").html(numberWithCommas(data.total_contrib_ytd));
  $("#actualytd4").html(
    numberWithpercentage(data.total_contrib_ytd_percentage)
  );
  var c75 = parseFloat(data.ytd_country_overhead);
  $("#actualytd5").html(numberWithCommas(c75));
  $("#actualytd6").html(numberWithCommas(data.ytd_country_overhead));
  var c78 =
    parseFloat(data.total_contrib_ytd) -
    parseFloat(getNum(ifnullVal(data.ytd_country_overhead)));
  $("#actualytd61").html(numberWithCommas(c78.toFixed(2)));
  $("#actualytd62").html(
    numberWithpercentage(
      (
        (parseFloat(ifnullVal(c78)) /
          parseFloat(ifnullVal(data.total_fee_ytd))) *
        100
      ).toFixed(2)
    )
  );
  $("#actualytd7").html(numberWithCommas(data.ytd_divisional_overhead));
  $("#actualytd71").html(numberWithCommas(data.ytd_divisional_overhead));
  var c7718 =
    parseFloat(data.total_contrib_ytd) -
    (parseFloat(getNum(ifnullVal(data.ytd_divisional_overhead))) +
      parseFloat(getNum(ifnullVal(data.ytd_country_overhead))));
  $("#actualytd72").html(numberWithCommas(c7718.toFixed(2)));
  $("#actualytd73").html(
    numberWithpercentage(
      (
        (parseFloat(ifnullVal(c7718)) /
          parseFloat(ifnullVal(data.total_fee_ytd))) *
        100
      ).toFixed(2)
    )
  );

  $("#actualytd10").html(numberWithCommas(data.ytd_wip));
  var c711 =
    parseFloat(ifnullVal(data.ytd_wip)) /
    (parseFloat(ifnullVal(data.total_rev1_ytd)) / parseFloat(data.month_days));
  $("#actualytd11").html(numberWithactual(c711));
  $("#actualytd12").html(numberWithCommas(data.ytd_debtors));
  var c713 =
    parseFloat(ifnullVal(data.ytd_debtors)) /
    (parseFloat(ifnullVal(data.total_rev1_ytd)) / parseFloat(data.month_days));
  $("#actualytd13").html(numberWithactual(c713));

  // column 8
  $("#ytdforcast2").html(numberWithCommas(data.ytd_forcast_fee));
  $("#ytdforcast3").html(numberWithCommas(data.ytd_forcast_contrib));
  $("#ytdforcast4").html(numberWithpercentage(data.ytd_forcast_fee_percen));
  $("#ytdforcast8").html(numberWithCommas(data.ytd_forcast_contrib));
  $("#ytdforcast9").html(numberWithpercentage(data.ytd_forcast_fee_percen));

  // column 9
  $("#ytdbudget2").html(numberWithCommas(data.ytd_budget_fee));
  $("#ytdbudget3").html(numberWithCommas(data.ytd_budget_contrib));
  $("#ytdbudget4").html(
    numberWithpercentage(
      (
        (parseFloat(data.ytd_budget_contrib) /
          parseFloat(data.ytd_budget_fee)) *
        100
      ).toFixed(2)
    )
  );
  var c95 = parseFloat(data.ytd_country_overhead_budget);
  $("#ytdbudget5").html(numberWithCommas(c95));
  $("#ytdbudget6").html(numberWithCommas(data.ytd_country_overhead_budget));
  var c98 =
    parseFloat(data.ytd_budget_contrib) -
    parseFloat(getNum(ifnullVal(data.ytd_country_overhead_budget)));
  $("#ytdbudget61").html(numberWithCommas(c98.toFixed(2)));
  $("#ytdbudget62").html(
    numberWithpercentage(
      (
        (parseFloat(ifnullVal(c98)) /
          parseFloat(ifnullVal(data.ytd_budget_fee))) *
        100
      ).toFixed(2)
    )
  );
  $("#ytdbudget7").html(numberWithCommas(data.ytd_divisional_overhead_budget));
  $("#ytdbudget71").html(numberWithCommas(data.ytd_divisional_overhead_budget));
  var c7298 =
    parseFloat(data.ytd_budget_contrib) -
    (parseFloat(getNum(ifnullVal(data.ytd_divisional_overhead_budget))) +
      parseFloat(getNum(ifnullVal(data.ytd_country_overhead_budget))));
  $("#ytdbudget72").html(numberWithCommas(c7298.toFixed(2)));
  $("#ytdbudget73").html(
    numberWithpercentage(
      (
        (parseFloat(ifnullVal(c7298)) /
          parseFloat(ifnullVal(data.ytd_budget_fee))) *
        100
      ).toFixed(2)
    )
  );

  // column 10
  var c102 =
    parseFloat(ifnullVal(data.total_fee_ytd)) -
    parseFloat(ifnullVal(data.ytd_budget_fee));
  $("#ytdyartobudget2").html(numberWithCommas(c102.toFixed(2)));
  conditionalFormating("ytdyartobudget2", c102);
  var c103 =
    parseFloat(ifnullVal(data.total_contrib_ytd)) -
    parseFloat(ifnullVal(data.ytd_budget_contrib));
  $("#ytdyartobudget3").html(numberWithCommas(c103.toFixed(2)));
  conditionalFormating("ytdyartobudget3", c103);

  // $("#ytdyartobudget4").html(numberWithCommas(0));
  $("#ytdyartobudget5").html(numberWithCommas(c75 - c95));
  conditionalFormatingOH("ytdyartobudget5", c75 - c95);

  var c107 =
    ifnullVal(data.ytd_divisional_overhead) -
    ifnullVal(data.ytd_divisional_overhead_budget);
  $("#ytdyartobudget7").html(numberWithCommas(c107.toFixed(2)));
  conditionalFormatingOH("ytdyartobudget7", c107);
  // $("#ytdyartobudget9").html(numberWithCommas(0));

  // column 11
  var c112 =
    (ifnullVal(data.total_fee_ytd) /
      parseFloat(ifnullVal(data.ytd_budget_fee))) *
    100;
  c112 = isFinite(c112) ? c112 : 0;
  $("#ytdinpercenofbudget2").html(numberWithpercentage(c112.toFixed(2)));
  conditionalFormatingpercentage("ytdinpercenofbudget2", c112);
  var c113 =
    (ifnullVal(data.total_contrib_ytd) /
      parseFloat(ifnullVal(data.ytd_budget_contrib))) *
    100;
  c113 = isFinite(c113) ? c113 : 0;
  $("#ytdinpercenofbudget3").html(numberWithpercentage(c113.toFixed(2)));
  conditionalFormatingpercentage("ytdinpercenofbudget3", c113);

  // $("#ytdinpercenofbudget4").html(numberWithCommas(0));
  // $("#ytdinpercenofbudget8").html(
  //   numberWithCommas(ifnullVal(data.net_mtd_contribution) - ifnullVal(0))
  // );
  // $("#ytdinpercenofbudget9").html(numberWithCommas(0));
};
function ifnullVal(p) {
  var v = p == null || p == "" ? 0 : p;
  return v;
}
function getNum(val) {
  if (isNaN(val)) {
    return 0;
  }
  return val;
}
function numberWithCommas(x) {
  if (x == null || x == "" || x == "null") {
    x = 0;
  }
  x = getNum(x);
  x = Math.ceil(x);
  var xinthousand = (parseFloat(x) / 1000)
    .toFixed(0)
    .toString()
    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  var v =
    "<span style='font-size:14px;float: right;'>" + xinthousand + "</span>";
  // var v = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return v;
}
function numberWithpercentage(x) {
  if (x == null || x == "" || x == "null") {
    x = 0;
  }
  x = getNum(x);
  x = parseFloat(x).toFixed(1);
  // x = Math.ceil(x);
  var xinthousand = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  var v =
    "<span style='font-size:14px;float: right;'>" + xinthousand + "% </span>";
  // var v = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return v;
}
function numberWithactual(x) {
  if (x == null || x == "" || x == "null") {
    x = 0;
  }
  x = getNum(x);
  x = Math.ceil(x);
  var xinthousand = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  var v =
    "<span style='font-size:14px;float: right;'>" + xinthousand + "</span>";
  // var v = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return v;
}
function conditionalFormating(_id, val) {
  var number = val;
  var sign = number > 0 ? "green" : "red";
  $("#" + _id).css("color", sign);
}
function conditionalFormatingOH(_id, val) {
  var number = val;
  var sign = number > 0 ? "red" : "green";
  $("#" + _id).css("color", sign);
}
function conditionalFormatingpercentage(_id, val) {
  var number = val;
  var sign = number >= 100 ? "green" : "red";
  $("#" + _id).css("color", sign);
}
// top table  end

// charts
var getChartFunctions = function (paramJ) {
  var response = getAjaxRequest("pprScript/server/getChartsData.php", paramJ);
  var data = response;
  var resStatus = data[0]["msgstatus"];
  if (resStatus == "402") {
    // alert("No Record Found");
    data = [];
  } else {
  }
  return data;
};
var loadChartFunctions = function (params) {
  //filters params
  // var params = { devision: "1", region: "1", country: "2", sector: "1" };

  params["chart"] = "projectChartCounts";
  var res = getChartFunctions(params);
  piechartsFunction(res, "projectChartCounts", "pie", true, "Project Counts");

  params["chart"] = "MTDFeeChartByRegion";
  var res = getChartFunctions(params);
  //pie
  piechartsFunction(
    res,
    "MTDFeeChartByRegion",
    "pie",
    true,
    "MTD Fee(M) By Region"
  );

  params["chart"] = "MTDFeeChartBySector";
  var res = getChartFunctions(params);
  piechartsFunction(
    res,
    "MTDFeeChartBySector",
    "pie",
    true,
    "MTD Fee(M) By Sector"
  );

  params["chart"] = "WipAndDebtorChart";
  var res = getChartFunctions(params);
  stackedchartsFunction(
    res,
    "WipAndDebtorChart",
    "column",
    true,
    "column,column",
    "WIP and Debtors (M)",
    "WIP,Debtors",
    "normal",
    ["#79a9ce", "#1d3a67"]
  );

  params["chart"] = "MonthlyPercenMTDFeeRevenueChart";
  var res = getChartFunctions(params);
  stackedchartsFunction(
    res,
    "MonthlyPercenMTDFeeRevenueChart",
    "column",
    true,
    "column,column",
    "Monthly Reviews by %",
    "Yes,No",
    "normal",
    ["#79a9ce", "#1d3a67"]
  );

  params["chart"] = "PPRChartRevenueVsContribution";
  var res = getChartFunctions(params);
  // console.log(res);
  stackedchartsFunction(
    res,
    "PPRChartRevenueVsContribution",
    "column",
    true,
    "column,column",
    "Revenue and Contribuion (M)",
    "Revenue,Contribuion",
    false,
    ["#79a9ce", "#1d3a67"]
  );

  params["chart"] = "SectorWiseYTDFeeByCountChart";
  var res = getChartFunctions(params);
  multiserieschartsFunction(
    res,
    "SectorWiseYTDFeeByCountChart",
    true,
    "Sector wise YTD Fee(M) by Region"
  );

  params["chart"] = "SectorWiseYTDNWWByCountChart";
  var res = getChartFunctions(params);
  multiserieschartsFunction(
    res,
    "SectorWiseYTDNWWByCountChart",
    true,
    "Sector wise YTD NWW(M) by Region"
  );

  params["chart"] = "MonthlyInvoicesStatisticChart";
  var res = getChartFunctions(params);
  dualaxischartFunction(
    res,
    "MonthlyInvoicesStatisticChart",
    "xy",
    true,
    "Monthly Invoicing(M) Statistics",
    ["#79a9ce", "#1d3a67"]
  );
};

// highcharts function
var piechartsFunction = function (JData, chartID, CT, lgnd, chartTitle) {
  var lbl = [],
    vals = [];
  for (var i = 0; i < JData.length; i++) {
    // lbl.push(JData[i].lbl);
    vals.push({ name: JData[i].lbl, y: parseFloat(JData[i].vals) });
  }
  var iscountslbl = "";
  var iscountsdesiml = 0;
  if (chartID == "projectChartCounts") {
    iscountslbl = "";
    iscountsdesiml = 0;
  } else {
    iscountslbl = ""; //"M";
    iscountsdesiml = 1;
  }
  // Create the chart
  Highcharts.chart(chartID, {
    chart: {
      type: CT,
    },
    title: {
      text: chartTitle,
    },
    accessibility: {
      announceNewData: {
        enabled: true,
      },
      point: {
        valueSuffix: "%",
      },
    },
    plotOptions: {
      series: {
        borderRadius: 5,
        dataLabels: {
          enabled: true,
          // <b>{point.name}</b>:
          format:
            "{point.y:." +
            iscountsdesiml +
            "f} " +
            iscountslbl +
            " ({point.percentage:.1f}%)",
          // "{point.name}: {point.y:." + iscountsdesiml + "f} " + iscountslbl,
        },
        showInLegend: lgnd,
      },
    },
    legend: {
      enabled: lgnd,
    },
    tooltip: {
      headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
      pointFormat:
        '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.' +
        iscountsdesiml +
        "f} " +
        iscountslbl +
        "</b><br/>",
    },
    credits: {
      enabled: false,
    },
    series: [
      {
        name: "",
        colorByPoint: true,
        data: vals,
      },
    ],
  });
};
var barchartsFunction = function (JData, chartID, CT, lgnd, chartTitle) {
  var lbl = [],
    vals = [];
  for (var i = 0; i < JData.length; i++) {
    lbl.push(JData[i].lbl);
    vals.push(parseFloat(JData[i].vals));
  }

  Highcharts.chart(chartID, {
    chart: {
      type: CT,
    },
    title: {
      // align: "left",
      text: chartTitle,
    },
    accessibility: {
      announceNewData: {
        enabled: true,
      },
    },
    xAxis: {
      categories: lbl,
      // type: "category",
    },
    yAxis: {
      title: {
        text: "",
      },
    },
    legend: {
      enabled: lgnd,
    },
    credits: {
      enabled: false,
    },
    plotOptions: {
      series: {
        borderWidth: 0,
        dataLabels: {
          enabled: true,
          format: "{point.y:.1f}",
        },
      },
    },

    tooltip: {
      headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
      pointFormat:
        '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>',
    },

    series: [
      {
        name: "Projects",
        colorByPoint: true,
        pointWidth: 30,
        data: vals,
      },
    ],
  });
};
var stackedchartsFunction = function (
  JData,
  chartID,
  CT,
  lgnd,
  nestedChart,
  chartTitle,
  datasetLBL,
  isStacked,
  colorArr
) {
  var lbl = [],
    vals = [],
    vals1 = [];
  var NC = nestedChart.split(",");
  var DL = datasetLBL.split(",");
  // var Stk = isStacked.split(",");
  for (var i = 0; i < JData.length; i++) {
    lbl.push(JData[i].lbl);
    vals.push(parseFloat(JData[i].vals));
    vals1.push(parseFloat(JData[i].vals1));
  }
  // console.log(vals);
  var isylbl = "";
  if (chartID == "MonthlyPercenMTDFeeRevenueChart") {
    isylbl = "";
  } else {
    isylbl = "Million";
  }

  Highcharts.chart(chartID, {
    chart: {
      type: CT,
    },
    title: {
      text: chartTitle,
    },
    xAxis: {
      categories: lbl,
    },
    yAxis: {
      visible: false,
      min: 0,
      title: {
        text: isylbl,
      },
      stackLabels: {
        enabled: false,
      },
    },
    credits: {
      enabled: false,
    },
    legend: {
      enabled: lgnd,
      // align: "left",
      // x: 70,
      // verticalAlign: "top",
      // y: 70,
      // floating: true,
      // backgroundColor:
      //   Highcharts.defaultOptions.legend.backgroundColor || "white",
      // borderColor: "#CCC",
      // borderWidth: 1,
      // shadow: false,
    },
    tooltip: {
      headerFormat: "<b>{point.x}</b><br/>",
      pointFormat: "{series.name}: {point.y}<br/>Total: {point.stackTotal}",
    },
    plotOptions: {
      column: {
        stacking: isStacked,
        dataLabels: {
          enabled: true,
          format: "{point.y:.1f}",
        },
      },
    },
    series: [
      {
        name: DL[0],
        data: vals,
        color: colorArr[0],
        pointWidth: 30,
      },
      {
        name: DL[1],
        data: vals1,
        color: colorArr[1],
        pointWidth: 30,
      },
    ],
  });
};
var multiserieschartsFunction = function (JData, chartID, lgnd, ctitle) {
  var lbl = [],
    trans = [],
    water = [],
    renew = [],
    urban = [],
    internal = [],
    other = [];
  for (var i = 0; i < JData.length; i++) {
    lbl.push(JData[i].lbl);
    trans.push(parseFloat(JData[i].vals_trans));
    water.push(parseFloat(JData[i].vals_water));
    renew.push(parseFloat(JData[i].vals_renewable));
    urban.push(parseFloat(JData[i].vals_urban));
    other.push(parseFloat(JData[i].vals_others));
    internal.push(parseFloat(JData[i].vals_internal));
  }

  Highcharts.chart(chartID, {
    chart: {
      type: "column",
    },
    title: {
      text: ctitle,
    },
    xAxis: {
      categories: lbl,
    },
    yAxis: {
      visible: false,
      min: 0,
      title: {
        text: "Millions",
      },
      stackLabels: {
        enabled: false,
      },
    },
    credits: {
      enabled: false,
    },
    legend: {
      enabled: lgnd,
    },
    tooltip: {
      headerFormat: "<b>{point.x}</b><br/>",
      pointFormat: "{series.name}: {point.y}",
    },
    plotOptions: {
      column: {
        stacking: false,
        dataLabels: {
          enabled: true,
          format: "{point.y:.1f}",
        },
      },
    },
    series: [
      {
        name: "Transportation",
        data: trans, //Samples.utils.numbers(NUMBER_CFG),
        color: "#F6C501", //getRandomColor(trans.length),
        pointWidth: 15,
      },
      {
        name: "Water",
        data: water, //Samples.utils.numbers(NUMBER_CFG),
        color: "#1AA3E8", //getRandomColor(water.length),
        pointWidth: 15,
      },
      {
        name: "Renewables",
        data: renew, //Samples.utils.numbers(NUMBER_CFG),
        color: "#BD0123", //getRandomColor(renew.length),
        pointWidth: 15,
      },
      {
        name: "Urban",
        data: urban, //Samples.utils.numbers(NUMBER_CFG),
        color: "#0CF608", //getRandomColor(urban.length),
        pointWidth: 15,
      },
      {
        name: "Others",
        data: other, //Samples.utils.numbers(NUMBER_CFG),
        color: "#F0371C", //getRandomColor(other.length),
        pointWidth: 15,
      },
      // {
      //   name: "Internal",
      //   data: internal, //Samples.utils.numbers(NUMBER_CFG),
      //   color: "#084B82", //getRandomColor(internal.length),
      //   pointWidth: 15,
      // },
    ],
  });
};
var dualaxischartFunction = function (
  JData,
  chartID,
  CT,
  lgnd,
  chartTitle,
  colrs
) {
  var lbl = [],
    vals = [],
    vals1 = [];
  for (var i = 0; i < JData.length; i++) {
    lbl.push(JData[i].lbl);
    vals.push(parseFloat(JData[i].vals));
    vals1.push(parseFloat(JData[i].vals1));
  }

  Highcharts.chart(chartID, {
    chart: {
      zoomType: CT,
    },
    title: {
      text: chartTitle,
    },
    xAxis: [
      {
        categories: lbl,
        crosshair: true,
      },
    ],
    yAxis: [
      {
        visible: false,
        // Primary yAxis
        labels: {
          // format: "{value}°C",
          style: {
            color: colrs[1],
          },
        },
        title: {
          text: "Invoice Count",
          style: {
            color: colrs[1],
          },
        },
      },
      {
        visible: false,
        // Secondary yAxis
        title: {
          text: "Millions",
          style: {
            color: colrs[0],
          },
        },
        labels: {
          // format: "{value} mm",
          style: {
            color: colrs[0],
          },
        },
        opposite: true,
      },
    ],
    // plotOptions: {
    //   series: {
    //     borderWidth: 0,
    //     dataLabels: {
    //       enabled: true,
    //       format: "{point.y:.1f}",
    //     },
    //   },
    // },

    credits: {
      enabled: false,
    },
    tooltip: {
      shared: true,
    },
    legend: {
      enabled: lgnd,
    },
    series: [
      {
        name: "Total Invoiced",
        type: "column",
        yAxis: 1,
        data: vals,
        pointWidth: 30,
        // tooltip: {
        //   valueSuffix: " mm",
        // },
        dataLabels: {
          x: 0,
          y: 80,
          // align: "right",
          enabled: true,
          format: "{point.y:.1f}",
        },
      },
      {
        name: "Invoiced Count",
        type: "spline",
        data: vals1,
        // tooltip: {
        //   valueSuffix: "°C",
        // },
        dataLabels: {
          // x: 0,
          // y: 80,
          enabled: true,
          format: "{point.y}",
        },
      },
    ],
  });
};

function getRandomColor(count) {
  var colors = [];
  for (var i = 0; i < count; i++) {
    var letters = "0123456789ABCDEF".split("");
    var color = "#";
    for (var x = 0; x < 6; x++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    colors.push(color);
  }
  return colors;
}
