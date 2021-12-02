<!-- gateway -->
    <section class="py-5 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div style="border: 2px solid #66C3AB !important;border-radius: 1em;">
                        <div class="card-body p-4">
                            <h1 class="text-white fw-bold mb-0">
                               Staking Data
                            </h1>
                            <p class="text-white css-theta-subhead mb-4">Y: Guardian Nodes &nbsp; X: Staked Amount</p>
							<p id="myCaption-guards" class="">Searching...</p>
							<div class="jsT-chart-container">
								<canvas id="myChart-guards" class="my-4 jsT-charts" data-chartpath="guards" width="900" height="380"></canvas>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- gateway -->

    <!-- about -->
    <section class="about py-3">
        <div class="container css-tw-pagebody-lg">
            <div class="row">
                <!-- filter cta -->
				<div class="css-tw-linkboxes col-md-3 mx-auto px-1" id="triggerSearch">
					<form name="triggerSearch" class="jsT-loadChart" data-chartpath="guards">
						<div class="form-row">
							<div class="col-12 col-md-7 mb-4 form-group">
								<label class="text-white fw-bold mb-0" for="range_start">Range Start</label>
								<input id="jsT-beginRange" class="jsT-updateChart form-control" data-chartpath="guards" name="range_start" type="text" value="1000">
							</div>
						</div>
						<div class="form-row">
							<div class="col-12 col-md-7 mb-4 form-group">
								<label class="text-white fw-bold mb-0" for="range_end">Range End</label>
								<input id="jsT-endRange" class="jsT-updateChart form-control" data-chartpath="guards" name="range_end" type="text" value="5100">
							</div>
						</div>
						<div class="form-row">
							<div class="col-12 col-md-7 mb-4 form-group">
								<label class="text-white fw-bold mb-0 d-block" for="range_increment">Increment</label>
								<select name="range_increment" id="jsT-selectRange" class="jsT-updateChart col-12 col-md-10 form-control" data-chartpath="guards">
								<option value="100">100</option>
								<option value="1000">1,000</option>
								<option value="2500">2,500</option>
								<option value="5000">5,000</option>
								<option value="10000">10,000</option>
								<option value="25000">25,000</option>
								<option value="50000">50,000</option>
								<option value="100000">100,000</option>
								<option value="250000">250,000</option>
								<option value="500000">500,000</option>
								<option value="1000000">1,000,000</option>
								</select>
							</div>
							<div class="col-12 col-md-7 form-group">
								<label class="text-white fw-bold mb-0 d-block" for="range_withdrawals">Withdrawals</label>
								<span class="d-inline-block text-info"><input class="jsT-updateChart" type="radio" name="range_withdrawals" value="1" checked="checked"> Show</span>
								&nbsp;&nbsp;<span class="d-inline-block text-info"><input class="jsT-updateChart" type="radio" name="range_withdrawals" value="0"> Hide</span>
							</div>
						</div>
					</form>
				</div>
				<!-- filter cta -->
				<div class="col-md-8 pt-3" style="padding-left: 60px !important;">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
						<h1 id="print-title" class="h2 text-white">Nodes by Staked Amt.</h1>
						<p  id="table-search-caption" class="d-none"></p>
						<div class="btn-toolbar mb-2 mb-md-0">
							<div class="btn-group mr-0">
								<a href="#" id="js-export-trigger" class="btn btn-light rounded-pill submitBtn">Export&nbsp;CSV</a>
								&nbsp;&nbsp;&nbsp;<a href="#" id="js-print-trigger" class="btn btn-light rounded-pill submitBtn">Print</a>
							</div>
						</div>
					</div>
					<div id="print-div" class="table-responsive cssT-mono">
						<table id="myTable-guards" class="table table-sm jsT-table">
							<thead class="jsT-table-head">
							<tr>
								<th class="js-header-col text-white" style="border-top:none !important;">Range Start</th>
								<th class="js-header-col text-white" style="border-top:none !important;">Range End</th>
								<th class="js-header-col text-white js-unstake-col text-right" style="border-top:none !important;">Pending Withdrawals</th>
								<th class="js-header-col text-white text-right" style="border-top:none !important;">Staked Nodes</th>
							</tr>
							</thead>
							<tbody class="jsT-table-rows">
								<tr>
									<td class=" text-white" colspan="3">Searching...</td>
								</tr>
							</tbody>
						</table>
					</div>
                </div>
            </div>
        </div>
    </section>
    <!-- about -->