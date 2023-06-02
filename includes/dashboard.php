 <?php 
$_SESSION['menu'] = "Order";

require_once "models/order.class.php";
require_once "models/receipt.class.php";
require_once "models/cheque.class.php";
require_once "models/invoice.class.php";
require_once "models/account.class.php";
require_once "models/report.class.php";
require_once "models/product.class.php";

$order = new Order();
$receipt = new Receipt();
$cheque = new Cheque();
$invoice = new Invoice();
$account = new Account();
$report = new Report();
$product = new Product();
?>


<!-- Column -->
<div class="card">
	<div class="card-body">
	
			<div class="row">
					<div class="col-12 col-sm-12 col-md-6 col-lg-6">
					                       
							<figure class="highcharts-figure">
								<div id="chartsales" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
							</figure>
							<figure class="highcharts-figure">
								<div id="chartbook"></div>								
							</figure>
							<figure class="highcharts-figure">
								<div id="chartebook"></div>								
							</figure>
					
							<figure class="highcharts-figure">
								<div id="charttop"></div>								
							</figure>	
							
					</div>
					
					<div class="col-12 col-sm-6 col-md-6 col-lg-6">					
								<div class="row">
										<!-- Column -->
										<?php 
											$cntpo = $order->CountWaitConfirm();
											if($cntpo>0){
										?> 
										<div class="col-12 col-sm-12 col-md-12 col-lg-12">
											<div class="card bg-cyan text-white">
												<div class="card-body ">
													<div class="row weather">
														<div class="col-6 col-sm-6 col-md-6 col-lg-6">
															<h1 class="m-b-"><i class=" far fa-file-alt"></i></h1>
															<h4 class="text-white">ใบสั่งซื้อใหม่รอยืนยัน</h4>		
															<?php 
															$cntbook = $order->CountBookWaitConfirm();
															if($cntbook>0){
															?>
															<h4 class="text-white font-bold">- มีหนังสือ <?php echo  $cntbook?> PO</h4>
															<?php } ?>
															<?php
															$cntbillto = $order->CountBillTo();
															if($cntbillto>0){
															?>															
															<h4 class="text-white font-bold">- ต้องออกใบกำกับภาษี <?php echo  $cntbillto; ?> PO</h4>
															<?php } ?>															
														</div>
														<div class="col-6 col-sm-6 col-md-6 col-lg-6 m-t-40  text-right">															
															<div class="display-4"><a href="checkorder.php"><?php echo $cntpo;?> <sup>PO</sup></a></div>										
														</div>
														
													</div>
												</div>
											</div>
										</div>
										<?php } ?>
										<!-- Column -->

										<!-- Column -->
										<?php 
										$cntdo = $order->CountWaitDelivery();
										if($cntdo >0){
										?> 
										<div class="col-12 col-sm-12 col-md-12 col-lg-12">
											<div class="card bg-info text-white">
												<div class="card-body ">
													<div class="row weather">
														<div class="col-6">
															<h1 class="m-b-"><i class="fas fa-truck"></i></h1>
															<h4 class="text-white">รายการสินค้ารอส่งลูกค้า</h4>					
														</div>
														<div class="col-6 m-t-40  text-right">															
															<div class="display-4"><a href="checkdo.php"><?php  echo $cntdo;?> <sup>PO</sup></a></div>
															
														</div>
														
													</div>
												</div>
											</div>
										</div>
										<?php  } ?>
										<!-- Column -->
										
										
										<!-- Column -->
										<?php 
										$cntrp = $receipt->CountWaitChequeReceive();
										if($cntrp>0){
										?> 
										<div class="col-12 col-sm-12 col-md-12 col-lg-12">
											<div class="card bg-purple text-white">
												<div class="card-body ">
													<div class="row weather">
														<div class="col-6">
															<h1 class="m-b-"><i class="fas fa-money-bill-alt"></i></h1>
															<h4 class="text-white">รายการรอรับเช็ค</h4>					
														</div>
														<div class="col-6 m-t-40  text-right">
															<div class="display-4 text-white"><a href="checkcq.php"><?php  echo $cntrp;?> <sup>RP</sup></a></div>										
														</div>									
													</div>
												</div>
											</div>
										</div>
										<?php  } ?>
										<!-- Column -->				

										<!-- Column -->
										<?php 
										$cntcq = $cheque->CountWaitChequeReceive();
										if($cntcq>0){
										?>
										<div class="col-12 col-sm-12 col-md-12 col-lg-12">
											<div class="card bg-success text-white">
												<div class="card-body ">
													<div class="row weather">
														<div class="col-6">
															<h1 class="m-b-"><i class="fas fa-money-bill-alt"></i></h1>
															<h4 class="text-white">รายการรอผ่านเช็ค</h4>					
														</div>
														<div class="col-6 m-t-40  text-right">															
															<div class="display-4 text-white"><a href="cqpass.php"><?php  echo $cntcq;?> <sup>CQ</sup></a></div>
															
														</div>
														
													</div>
												</div>
											</div>
										</div>
										<?php  } ?>
										<!-- Column -->							

								</div><!--/row-->		

								<figure class="highcharts-figure">
									<div id="piebook"></div>								
								</figure>
								<figure class="highcharts-figure">
									<div id="pieebook"></div>								
								</figure>										
						
					</div>
		</div>

	
	</div><!-- /card-body -->
</div>

<?php 
$str_key  = "";
$str_income  = "";
$str_expense  = "";
$str_total  = "";
$query = $account->ReportMonthlySummary();
$result = $query->fetchAll();
foreach($result as $item){	
	$key = $item["monthno"]."-".$item["yearno"];	
	$str_key  .= "'".$key."',";
	$str_income .=  $item["income"].",";
	$str_expense .=  $item["expense"].",";
	$str_total .=  ($item["income"] - $item["expense"]).",";
}
?>

<script type="text/javascript">
Highcharts.chart('chartsales', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Monthly Summary'
    },
    subtitle: {
        text: 'สรุปรายการย้อนหลัง 1 ปี'
    },
    xAxis: {
		
        categories: [<?php  echo $str_key; ?>],
		gridLineWidth: 1
    },
    yAxis: {
        title: {
            text: 'จำนวนเงิน(บาท)'
        },
        labels: {
            formatter: function () {
                return   this.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); + '';
            }
        }
    },
	credits: {
		enabled: false
	},		
   tooltip: {
       crosshairs: true,
       shared: true
    },
	//tooltip: {
	//	headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
	//	pointFormat: '<span style="color:{point.color}">{point.name}</span><b>{point.y}</b><br/>'
	//},		
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [
	{
        name: 'ยอดขาย',
        marker: {
            symbol: 'square'
        },
        data: [<?php  echo $str_income; ?>]

    }, 
	 {
        name: 'รายจ่าย',
        marker: {
            symbol: 'diamond'
        },
        data: [<?php  echo $str_expense; ?>]
    },
	 {
        name: 'ยอดสุทธิ',
        marker: {
            symbol: 'circle'
        },
        data: [<?php  echo $str_total; ?>]
    },	
	]
});
</script>

<script type="text/javascript">
Highcharts.chart('charttop', {
	chart: {
		type: 'cylinder',
		options3d: {
			enabled: true,
			alpha: 15,
			beta: 0,
			depth: 100,
			viewDistance: 25
		}
	},
	title: {
		text: 'Top 10 คอร์สเรียนออนไลน์'
	},
    subtitle: {
        text: 'สรุปรายการย้อนหลัง 1 ปี'
    },	
    xAxis: {
        type: 'category',
		 gridLineWidth: 1
    },
    yAxis: {
        title: {
            text: 'จำนวนขายได้ (Qty.)'
        },
		 gridLineWidth: 1
    },	
	credits: {
		enabled: false
	},		
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y}' //{point.y:2f}%
            }
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y} Qty</b> of total<br/>'
    },	
	series: [{
		name: 'สินค้า',
		colorByPoint: true,
		showInLegend: false,
		data: [
				<?php 
				$arr_prods  = array();
				$query = $report->Top10Course();
				$result = $query->fetchAll();
				foreach($result as $item){	
					//$arr_prods[$item["prodid"]] = $item["docqty"];
				
				?>				
					{
						name:'<?php  echo $item["prodname"];?>',
						y:<?php  echo $item["docqty"]; ?>
					},		
				<?php  } ?>
		]

	}]
});
</script>

<script type="text/javascript">
Highcharts.chart('chartbook', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Book Summary'
    },
    subtitle: {
        text: 'จำนวนขายหนังสือย้อนหลัง 1 ปี'
    },
    xAxis: {		
        categories: [<?php  echo $str_key; ?>], //month-year
		gridLineWidth: 1
    },
    yAxis: {
        title: {
            text: 'จำนวน(Qty)'
        },
        labels: {
            formatter: function () {
                return   this.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); + '';
            }
        }
    },
	credits: {
		enabled: false
	},		
   tooltip: {
       crosshairs: true,
       shared: true
    },	
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [
		<?php
		$query = $product->GetByCate('01');//หนังสือ
		$result = $query->fetchAll();
		foreach($result as $book){
				$str_qty = "";
				$query = $report->MonthlySumQty($book["prodid"]);
				$rstitem = $query->fetchAll();
				foreach($rstitem as $item){	
					$str_qty .=  $item["docqty"].",";
				}	
		?>
		{
			name: '<?php echo $book["prodname"] ?>',
			//marker: {
				//symbol: 'square'
			//},
			data: [<?php  echo $str_qty; ?>]
		}, 
		<?php } ?>
	]
});
</script>

<script type="text/javascript">
Highcharts.chart('chartebook', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'EBook Summary'
    },
    subtitle: {
        text: 'จำนวนขาย EBook ย้อนหลัง 1 ปี'
    },
    xAxis: {		
        categories: [<?php  echo $str_key; ?>], //month-year
		gridLineWidth: 1
    },
    yAxis: {
        title: {
            text: 'จำนวน(Qty)'
        },
        labels: {
            formatter: function () {
                return   this.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); + '';
            }
        }
    },
	credits: {
		enabled: false
	},		
   tooltip: {
       crosshairs: true,
       shared: true
    },	
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [
		<?php
		$query = $product->GetByCate('03');//ebook
		$result = $query->fetchAll();
		foreach($result as $book){
				$str_qty = "";
				$query = $report->MonthlySumQty($book["prodid"]);
				$rstitem = $query->fetchAll();
				foreach($rstitem as $item){	
					$str_qty .=  $item["docqty"].",";
				}	
		?>
		{
			name: '<?php echo $book["prodname"] ?>',
			//marker: {
				//symbol: 'square'
			//},
			data: [<?php  echo $str_qty; ?>]
		}, 
		<?php } ?>
	]
});
</script>


<script type="text/javascript">
Highcharts.chart('piebook', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'Book Compare'
    },
    subtitle: {
        text: 'เปรียบเทียบยอดขายหนังสือ'
    },	
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
	credits: {
		enabled: false
	},			
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 20,
            dataLabels: {
                enabled: true,
                format: '{point.name}: {point.y:.1f}%'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Percentage',
        data: [
		<?php
		$query = $product->GetByCate('01');//book
		$result = $query->fetchAll();
		foreach($result as $book){
				$str_qty = "";
				$query = $report->YearSumQty($book["prodid"]);
				$rstitem = $query->fetch();
		?>		
            ['<?php echo $book["prodname"] ?>', <?php echo $rstitem["docqty"] ?>],
		<?php } ?>	
        ]
    }]
});
</script>


<script type="text/javascript">
Highcharts.chart('pieebook', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'EBook Compare'
    },
    subtitle: {
        text: 'เปรียบเทียบยอดขาย Ebook'
    },	
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
	credits: {
		enabled: false
	},			
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 20,
            dataLabels: {
                enabled: true,              
				format: '{point.name}: {point.y:.1f}%'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Percentage',
        data: [
		<?php
		$query = $product->GetByCate('03');//ebook
		$result = $query->fetchAll();
		foreach($result as $book){
				$str_qty = "";
				$query = $report->YearSumQty($book["prodid"]);
				$rstitem = $query->fetch();
		?>		
            ['<?php echo $book["prodname"] ?>', <?php echo $rstitem["docqty"] ?>],
		<?php } ?>	
        ]
    }]
});
</script>
