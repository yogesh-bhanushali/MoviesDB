<div class="col-md-offset-3 col-md-6">
    <div class="panel panel-primary"> 
        <div class="panel-heading"> 
            <h3 class="panel-title">Transfer Funds</h3> 
        </div> 
        <div class="panel-body">
			<form class="form-horizontal col-md-8" name="add-beneficiary-form" id="add-beneficiary-form" url='{{route("beneficiary.add")}}'>
				<div class="form-group">
					<label for="BeneficiaryName">Beneficiary Account</label>
                    <select class="form-control" id="BeneficiaryID" name="BeneficiaryID" required>
	                    <option value="">Choose an option</option>
						@foreach($Benefeciaries as $key => $Benefeciary)
	                        <option value="{{ $Benefeciary->BeneficiaryID}}">{{ $Benefeciary->BeneficiaryAccnt }}</option>
	                    @endforeach
	                </select>
				</div>

				<div class="form-group">
					<label for="Amount">Transfer Amount ( Maximum - {{$AccountDetails[0]->CurrentBalance}} )</label>
					<input type="number" class="form-control" required  id="Amount" placeholder="Enter amount" >
				</div>
				<button type="button" class="btn btn-primary" onclick="transferFunds();">Submit</button>
			</form>
		</div>
	</div>
</div>