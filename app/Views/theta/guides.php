	<!-- gateway -->
    <section class="gateway py-5 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-transparent border-info">
                        <div class="card-body p-4">
                            <h1 class="text-white fw-bold mb-0">
                                Let's <span class="text-info">Get to Know</span> What Theta<br>
								Can Do For You
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
                    An unofficial guide to getting oriented to the growing list of Theta Network services. Here you'll find guides arranged in order of increasingly technical detail.
                </p>
                <p class="text-white">
                    <span class="text-info">
                        <strong>Beginnning </strong>
                    </span>
                    with blogs and introductory information for any casual curiosity.<br>
                    <span class="text-info">
                        <strong>Ending </strong> 
                    </span> with staking and developer whitesheets for the most advanced interests.
                </p>
            </div>
        </div>
    </section>
    <!-- in this session -->


    <!-- category -->
    <section class="category py-5">
        <div class="container css-tw-pagebody-lg">
            <div class="text-center">
                <h3 class="text-white">Jump to a Category</h3>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <a href="#thetaField-Glance" class="text-white text-decoration-none">
                            <div class="card h-33 border-info1 bg-transparent position-relative">
                                <div class="overlay"></div>
                                <div class="card-body text-start">
                                    <a href="" class="text-white text-decoration-none">
                                        At a Glance
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="#thetaField-streaming" class="text-white text-decoration-none">
                            <div class="card h-33 border-info1 bg-transparent position-relative">
                                <div class="overlay"></div>
                                <div class="card-body text-start">
                                    <a href="" class="text-white text-decoration-none">
                                        Streaming Resources
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
					
					<div class="col-md-4">
                        <a href="#thetaField-nfts" class="text-white text-decoration-none">
                            <div class="card h-33 border-info1 bg-transparent position-relative">
                                <div class="overlay"></div>
                                <div class="card-body text-start">
                                    <a href="" class="text-white text-decoration-none">
                                        NFTs on Theta
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
					
					<div class="col-md-4">
                        <a href="#thetaField-community" class="text-white text-decoration-none">
                            <div class="card h-33 border-info1 bg-transparent position-relative">
                                <div class="overlay"></div>
                                <div class="card-body text-start">
                                    <a href="" class="text-white text-decoration-none">
                                        Community & Communication
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="#thetaField-blockchain" class="text-white text-decoration-none">
                            <div class="card h-33 border-info1 bg-transparent position-relative">
                                <div class="overlay"></div>
                                <div class="card-body text-start">
                                    <a href="" class="text-white text-decoration-none">
                                        Blockchain Resources
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="#thetaField-tokens" class="text-white text-decoration-none">
                            <div class="card h-33 border-info1 bg-transparent position-relative">
                                <div class="overlay"></div>
                                <div class="card-body text-start">
                                    <a href="" class="text-white text-decoration-none">
                                        Tokens & Wallets
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="#thetaField-staking" class="text-white text-decoration-none">
                            <div class="card h-33 border-info1 bg-transparent position-relative">
                                <div class="overlay"></div>
                                <div class="card-body text-start">
                                    <a href="" class="text-white text-decoration-none">
                                        Staking & Node Information
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="#thetaField-developers" class="text-white text-decoration-none">
                            <div class="card h-33 border-info1 bg-transparent position-relative">
                                <div class="overlay"></div>
                                <div class="card-body text-start">
                                    <a href="" class="text-white text-decoration-none">
                                        Developer Resources
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
					
                </div>
            </div>
        </div>
    </section>
    <!-- category -->

    <!-- theta at a glance -->
    <?php echo view('guides/at-a-glance'); ?>
    <!-- theta at a glance -->

    <!-- streaming -->
	<?php echo view('guides/streaming-resources'); ?>
    <!-- streaming -->

    <!-- nfts -->
	<?php echo view('guides/nft-resources'); ?>
    <!-- nfts -->
	
	<!-- community -->
    <?php echo view('guides/community'); ?>
    <!-- community -->

	<!-- blockchain -->
    <?php echo view('guides/blockchain'); ?>
    <!-- blockchain -->

	<!-- tokens -->
    <?php echo view('guides/tokens'); ?>
    <!-- tokens -->

	<!-- staking -->
    <?php echo view('guides/staking'); ?>
    <!-- staking -->

	<!-- developer -->
    <?php echo view('guides/developer'); ?>
    <!-- developer -->
 

    <!-- signup cta -->
	<?php echo cta_block('contact-banner'); ?>
    <!-- signup cta -->