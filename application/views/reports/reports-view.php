
<div class="content-wrapper">
    <div class="form-group-create">
        <div class="row">
            <div class="col-sm-1">Region: </div>
            <div class="col-sm-3">
                <select name="region" id="region">
                    <option value="*">ALL</option>
                    <option value='CO'>CO</option>
                    <option value='NCR'>NCR</option>
                    <option value='R1'>Region 1</option>
                    <option value='CAR'>CAR</option>
                    <option value='ARMM'>ARMM</option>
                    <option value='R2'>Region 2</option>
                    <option value='R3'>Region 3</option>
                    <option value='R4A'>Region 4A</option>
                    <option value='R4B'>Region 4B</option>
                    <option value='R5'>Region 5</option>
                    <option value='R6'>Region 6</option>
                    <option value='R7'>Region 7</option>
                    <option value='R8'>Region 8</option>
                    <option value='R9'>Region 9</option>
                    <option value='R10'>Region 10</option>
                    <option value='R11'>Region 11</option>
                    <option value='R12'>Region 12</option>
                    <option value='R13'>Region 13</option>
                </select>
            </div>
            
            <div class="col-sm-1">Category: </div>
            <div class="col-sm-3">
                <select name='category' class="browser-default custom-select">
                    <option value='*'>ALL</option>
                    <option value='cu'>Current</option>
                    <option value='ca'>Continuing Appropriation</option>
                    <option value='aa'>Automatic Apporpriation</option>
                </select>
            </div>
            
            <div class="col-sm-4"></div>

            <div class="col-sm-1">Year: </div>
            <div class="col-sm-3"><input type="number" name="year" onKeyPress="if(this.value.length==4) return false;" /></div>
            
            <div class="col-sm-1">Type: </div>
            <div class="col-sm-3">
                <select name='type' class="browser-default custom-select">
                    <option value='*'>ALL</option>
                    <option value='sb'>Specific Budget</option>
                    <option value='sp'>Special Purpose Fund</option>
                    <option value='rlip'>RLIP</option>
                </select>
            </div>
            
            <div class="col-sm-4"></div>

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
            
            <div class="col-sm-1">Funding: </div>
            <div class="col-sm-3">
                <select name='funding' id="funding" class="browser-default custom-select">
                    <option value='*'>ALL</option>
                    <option value='as'>Agency Specific</option>
                    <option value='or'>Other Releases</option>
                    <option value='sa'>SAA</option>
                </select>
            </div>
            
            <div class="col-sm-4"></div>

            <div class="col-sm-4">
            <button name="generate" class='btn btn-primary' >Generate Report</button>
            </div>

            <div class="col-sm-1">Class: </div>
            <div class="col-sm-3">
                <select name='class' class="browser-default custom-select">
                    <option value='*'>ALL</option>
                    <option value='ps'>PS</option>
                    <option value='mo'>MOOE</option>
                    <option value='co'>CO</option>
                </select>
            </div>

            <div class="col-sm-4"></div>
        </div>
    </div>
</div>