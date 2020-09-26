<div class="col-md-offset-3 col-md-6">
    <div class="panel panel-primary"> 
        <div class="panel-heading"> 
            <h3 class="panel-title">Add Benefeciary</h3> 
        </div> 
        <div class="panel-body">
			<form class="form-horizontal col-md-8" name="add-beneficiary-form" id="add-beneficiary-form" url='{{route("beneficiary.add")}}'>
				<div class="form-group">
					<label for="BeneficiaryName">Beneficiary Name</label>
					<input type="name" class="form-control" required id="BeneficiaryName" placeholder="Enter beneficiary name" >
				</div>
				<div class="form-group">
					<label for="AccountNumber">Account Number</label>
					<input type="number" class="form-control" required id="AccountNumber" placeholder="Enter account number" >
				</div>
				<div class="form-group">
					<label for="IFSCCode">IFSC Code</label>
					<input type="text" class="form-control" required id="IFSCCode" placeholder="Enter IFSC Code" >
				</div>
				<div class="form-group">
					<label for="BranchCode">Branch Name</label>
					<input type="text" class="form-control" required id="BranchName" placeholder="Enter Branch Name" >
				</div>
				<button type="button" class="btn btn-primary" onclick="addBeneficiary();">Add</button>
			</form>
		</div>
	</div>
</div>