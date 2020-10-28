
<div class="content-wrapper">
    <div class="form-group-create">
        <div class="row">
        <div class="col-sm-1">Report: </div>
            <div class="col-sm-3">
                <select name='report' class="browser-default custom-select">
                    <option value=''>SELECT</option>
                    <option value='fp'>Fianancial Performance</option>
                    <option value='ut'>Utilization</option>
                </select>
            </div>

            <div class="col-sm-8"></div>

            <div class="col-sm-1">Category: </div>
            <div class="col-sm-3">
                <select name='category' class="browser-default custom-select">
                    <option value=''>SELECT</option>
                    <option value='cu'>Current</option>
                    <option value='ca'>Continuing Appropriation</option>
                    <option value='aa'>Automatic Appropriation</option>
                </select>
            </div>
            
            <div class="col-sm-1">Class: </div>
            <div class="col-sm-3">
                <select name='class' class="browser-default custom-select">
                    <option value=''>SELECT</option>
                    <option value='ps'>PS</option>
                    <option value='mo'>MOOE</option>
                    <option value='co'>CO</option>
                </select>
            </div>

            <div class="col-sm-4"></div>

            <div class="col-sm-1">Year: </div>
            <div class="col-sm-3"><input type="number" name="year" onKeyPress="if(this.value.length==4) return false;" /></div>

            <div class="col-sm-1">Month: </div>
            <div class="col-sm-3">
                <select name="month_from" id="month_from" size='1'>
                    <option value=''>SELECT</option>
                    <option value='1'>January</option>
                    <option value='2'>February</option>
                    <option value='3'>March</option>
                    <option value='4'>April</option>
                    <option value='5'>May</option>
                    <option value='6'>June</option>
                    <option value='7'>July</option>
                    <option value='8'>August</option>
                    <option value='9'>September</option>
                    <option value='10'>October</option>
                    <option value='11'>November</option>
                    <option value='12'>December</option>
                </select>

                -

                <select name="month_to" id="month_to" size='1'>
                    <option value=''>SELECT</option>
                    <option value='1'>January</option>
                    <option value='2'>February</option>
                    <option value='3'>March</option>
                    <option value='4'>April</option>
                    <option value='5'>May</option>
                    <option value='6'>June</option>
                    <option value='7'>July</option>
                    <option value='8'>August</option>
                    <option value='9'>September</option>
                    <option value='10'>October</option>
                    <option value='11'>November</option>
                    <option value='12'>December</option>
                </select>
            </div>
            
            <div class="col-sm-4"></div>

            <div class="col-sm-4">
            <button name="generate" id="generatebtn" class='btn btn-primary' >Generate Report</button>
            </div>
            
            <div class="col-sm-8"></div>

        </div>
    </div>

    <div class="reportDispHeader" style="display: none;"></div>
    <table id="myTable" style="display: none; text-align:center;" class="table table-striped table-bordered table-sm align reportDisp">
    </tbody>
    </table>

</div>