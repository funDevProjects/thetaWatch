	<!-- gateway -->
    <section class="gateway py-5 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-transparent border-info">
                        <div class="card-body p-4">
                            <h1 class="text-white fw-bold mb-0">
                                Easily <span class="text-info">Analyze & Explore</span> Theta's<br>
								Node Data Snapshots
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- gateway -->

    <!-- in this session -->
    <section class="session py-5 mt-5">
        <div class="container css-tw-pagebody">
            <div class="text-center lead">
                <h3 class="text-white mb-3">
                    In This Section
                </h3>
                <p class="text-white">
                    ThetaWatch uses the Theta Explorer API to archive snapshots of network node data. Here, you can easily search and filter these snapshots for your own needs.
                </p>
                <p class="text-white">
                    <span class="text-info">
                        <strong>Data Snapshots </strong>
                    </span>
                    are generated as needed and stored in an off-chain database.<br>
                    <span class="text-info">
                        <strong>Standardized Tools </strong> 
                    </span> are provided to simplify any search/print/download/charting needs.
                </p>
            </div>
        </div>
    </section>
    <!-- in this session -->


    <!-- category -->
    <section class="category py-5">
        <div class="container css-tw-pagebody-lg">
            <div class="text-center">
                <h3 class="text-white">Jump to a Report</h3>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <a href="#thetaField-Glance" class="text-white text-decoration-none">
                            <div class="card h-33 border-info1 bg-transparent position-relative">
                                <div class="overlay"></div>
                                <div class="card-body text-start">
                                    <span class="text-white text-decoration-none">
                                        Network Stats<br />At a Glance
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="#thetaField-staking" class="text-white text-decoration-none">
                            <div class="card h-33 border-info1 bg-transparent position-relative">
                                <div class="overlay"></div>
                                <div class="card-body text-start">
                                    <span class="text-white text-decoration-none">
                                        Node Staking <br />Reports
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
					
					<div class="col-md-4">
                        <a href="/contact-thetawatch" class="text-white text-decoration-none">
                            <div class="card h-33 border-info1 bg-transparent position-relative" style="background:#66C3AB !important">
                                <div class="overlay"></div>
                                <div class="card-body text-start">
                                    <span href="/contact-thetawatch" class="text-white text-decoration-none">
                                        NEW: <hr />Suggest a<br />Custom Report
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
					
                </div>
            </div>
        </div>
    </section>
    <!-- category -->

    <!-- stats at a glance -->
    <?php echo view('reports/at-a-glance'); ?>
    <!-- stats at a glance -->
 
    <!-- staking reports -->
    <?php echo view('reports/staking-reports'); ?>
    <!-- staking reportss -->
