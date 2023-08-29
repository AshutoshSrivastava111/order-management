
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-default">
			

			<div class="panel-body">
			<h3>Add Invoice</h3>
</div>
		<div class="container">
	
		<form action="<?php echo base_url();?>Product/save_order" id="addtransportorder" name="addtransportorder" method="post">
		
		
		<div class="row">
		<div class="col-md-4">
	<div class="form-group">
	<label>Name</label>
		<input id="name" type="text" class="form-control" required name="cust_name">
		</div>
		
		</div>
		
			<div class="col-md-4">
	<div class="form-group">
	<label>Email </label>
		<input id="email" type="text" class="form-control" required name="email" >
		</div>
		
		</div>
			<div class="col-md-4">
	<div class="form-group">
	<label>Phone</label>
		<input  type="text" class="form-control"  required name="phone" >
		</div>
		
		</div>
		

		
		</div>
		<div class="row" style="float:right; margin-right: 191px;" >
		<input type="button" class="btn btn-lg btn-block " id="addrow" value="Add Item" />
		</div>
	
    <table id="myTable" class=" table order-list">
	
	
    <thead>
        <tr>
           
		   <th>#</th>
			<th>Name</th>		
         	 <th>Quantity</th>	
			  			
			 <th>Rate</th>
		     <th>Amount (Rs)</th>
			 <th>Tools</th>
        </tr>
    </thead>
    <tbody>
        <tr>
           
            <td>
			<span>
                1
				</span>
            </td>
			 <td>
                <input type="text" name="name[]"  class="form-control"/>
            </td>
			<td>
                <input type="text" name="quantity[]"   class="form-control  CalcQty1"/>
            </td>
			
		
			 <td>
                <input type="text" name="rate[]"  class="form-control CalcRate1"/>
            </td>
			<td>
                <input type="text" name="amount[]"  class="form-control amount CaclcAmt1" value="0"/>
            </td>
            <td class="col-sm-2"><a class="deleteRow"></a>

            </td>
        </tr>
    </tbody>
	 <tfoot>
        <tr>
		<td colspan="2">
          <h4><b>Invoice Total</b> </h4>
         </td>
		 
		  <td>
          
         </td>
		 <td>
          
         </td>
			
            <td style="text-align: right;">
               <input id="total_amt" type="text" name="total_amount" class="form-control"  readonly>
            </td>
        </tr>
        <tr>
        </tr>
    </tfoot>
   
</table>


<div class="row">
<div class="col-md-6" style="margin-left: 209px;">
     <input type="submit" class="form-control btn-primary" required name="submit" value="Save" >
</div>
</div>
   

</form>

</div>

			</div> <!-- /panel-body -->		

		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->	
</div> <!-- /row-->



</body>
</html>

<script>



$(document).ready(function () {
    var counter = 2;

    $("#addrow").on("click", function () {

        var newRow = $("<tr>");
        var cols = "";
        
		cols += '<td><span>'+counter+ '</span></td>';	
		cols += '<td> <input type="text" name="name[]" required class="form-control" /></td>';	
        cols += '<td><input type="text" name="quantity[]" required  class="form-control  CalcQty'+counter+'" value="0"/></td>';
		cols += '<td> <input type="text" name="rate[]" required class="form-control  CalcRate'+counter+'" value="0"/></td>';
		cols += '<td> <input type="text" name="amount[]" required class="form-control amount CaclcAmt'+counter+'" value="0" /></td>';
        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
		
		
	
    });
	
	
 $("table.order-list").on("keyup", 'input[name^="quantity[]"],input[name^="rate[]"]', function (event) {
        calculateRow($(this).closest("tr"));
		
		//findeforeverygst();
		//findgst();
        calculateGrandTotal();
    });


	
	

    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();  
	
        counter -= 1
		calculateGrandTotal();
		
		reset_counter();
    });

	


});

function reset_counter(){
	var counter = 0;
	
	 $("table.order-list").find('input[name^="amount"]').each(function () {
		 //alert("hi");
		 counter = counter + 1;
		 $(this).closest("tr")
            .find("span").text( counter );
            
       
    });
	
	
}



function calculateRow(row) {
	
	// alert(row[0]);
	// console.log(row);
	       
     var price = row.find('input[name^="quantity[]"]').val();
	
    var qty = row.find('input[name^="rate[]"]').val();
	//	alert(price+""+qty);

    row.find('input[name^="amount[]"]').val((price * qty).toFixed(2));
	
	calculateGrandTotal
	

}




function calculateGrandTotal() {
    var grandTotal = 0;
    $("table.order-list").find('input[name^="amount"]').each(function () {
        grandTotal += +$(this).val();
		//alert(grandTotal);
    });
    $("#total_amt").val(grandTotal.toFixed(2));
}


</script>
