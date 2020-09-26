@if(count($Benefeciaries) > 0)
<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-primary"> 
        <div class="panel-heading"> 
            <h3 class="panel-title">Benefeciaries</h3> 
        </div> 
        <div class="panel-body">
            <table class="table"> 
                <thead> 
                    <tr>
                        <th>#</th>
                        <th>Beneficiary Name</th>
                        <th>IFSCCode</th>
                        <th>Branch Name</th>
                        <th>Account Number</th>
                    </tr> 
                </thead> 
                <tbody>
                    @foreach($Benefeciaries as $key => $benefeciary)
                        <tr> 
                            <th scope="row">{{$key+1}}</th> 
                            <td>{{$benefeciary->BeneficiaryName}}</td>
                            <td>{{$benefeciary->IFSCCode}}</td>
                            <td>{{$benefeciary->BranchName}}</td>
                            <td>{{$benefeciary->AccountNumber}}</td>
                        </tr>
                    @endforeach 
                </tbody> 
            </table>
        </div> 
    </div>
</div>
@endif