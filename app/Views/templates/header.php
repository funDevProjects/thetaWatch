<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="UTF-8">
	<title><?php echo $pageTitle; ?></title>
	<meta name="description" content="<?php echo $pageMeta; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>	
	
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	
	<!-- APPLICATION PATHS TO CSS / JS FILES -->
	<link rel="stylesheet" href="/css/thetawatch-styles.css">
	<link rel="stylesheet" href="/css/<?php echo $pageStyleSheet; ?>">
	
	<script src="/js/branded-scripts.js" /></script>
	<script src="/js/vendor-scripts.js" /></script>
</head>

<body>

<!-- HEADER: MENU -->
<header>
	<!-- navbar -->
    <section class="navbarSection py-2">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
                <div class="container-fluid">
                  <a class="navbar-brand" href="/">
					<img  title="ThetaWatch Logo"
						class="img-fluid logo"
						alt="ThetaWatch - News, Notes, Reports, and Resources"
						src="/theme/theta-watch-logo.png">
                  </a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link text-white" href="/browse-thetawatch-guides">LEARN</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-white" href="/explore-charts-on-thetawatch">EXPLORE</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-white" href="/donate-to-thetawatch">DONATE</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>
        </div>
    </section>
    <!-- navbar -->
</header>

<!-- CONTENT -->