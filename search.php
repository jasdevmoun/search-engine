<?php
// autoload the classes
function __autoload( $class ) {
	require_once './classes/' . $class .'.php'; 
}

$query = $_GET['q']; // query to be searched for
$scraper = new Scraper();
$content = $scraper->scrape($query);
$no_of_results = $scraper->result_count;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Meta Search Engine</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./styles/stylesheet.css">
	</head>

<body>
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <h1><a href="/">Meta Search</a></h1>
                    <h2>
                        <?php echo $no_of_results; ?> found for: <span class="text-navy"><?php echo $query; ?></span>
                    </h2>
                    <!-- <small>Request time  (0.23 seconds)</small> -->
        
                    <div class="search-form">
                        <form method="get">
                            <div class="input-group">
                                <input type="text" placeholder="<?php echo $query; ?>" name="q" class="form-control input-lg">

                                <div class="input-group-btn">
                                    <button class="btn btn-md btn-primary" type="submit">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="hr-line-dashed"></div>
                    
                    <?php foreach($content as $element): ?>
                    <div class="search-result">
                        <h3><a href="<?php echo $element['url']; ?>"><?php echo $element['title']; ?></a></h3>
                        <a href="<?php echo $element['url']; ?>" class="search-link"><?php echo $element['url']; ?></a>
                        <p class="text-muted">
                           <?php echo substr($element['desc'], strlen($element['url'])); ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                    

                    <div class="hr-line-dashed"></div>
                    
                    <!-- <div class="text-center">
                        <div class="btn-group">
                            <button class="btn btn-white" type="button"><i class="glyphicon glyphicon-chevron-left"></i></button>
                            <button class="btn btn-white">1</button>
                            <button class="btn btn-white  active">2</button>
                            <button class="btn btn-white">3</button>
                            <button class="btn btn-white">4</button>
                            <button class="btn btn-white">5</button>
                            <button class="btn btn-white">6</button>
                            <button class="btn btn-white">7</button>
                            <button class="btn btn-white" type="button"><i class="glyphicon glyphicon-chevron-right"></i> </button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
                    
</body>
</html>