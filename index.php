<!DOCTYPE html>
<html>
	<head>
		<title>Meta Search Engine</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	</head>

	<body>
		<header class="masthead d-flex jumbotron">
			<div class="container text-center my-auto">
				<h1 class="mb-2 display-2">Meta Search</h1>
				<p class="text-muted">An Open Source search-engine initiative</p>
				<h3 class="mb-5 center">
					<form class="form-inline d-flex justify-content-center" action="search.php" method="get">
						<div class="form-group mx-sm-3 mb-2">
							<label for="query" class="sr-only">Query</label>
							
							<input class="form-control border rounded-pill p-1 text-center" maxlength="2048" id="query" name="q" type="text" aria-autocomplete="both" aria-haspopup="false" autocapitalize="off" autocomplete="on" autocorrect="off" role="combobox" spellcheck="false" title="Search" value="" aria-label="Search" placeholder="Searching for..." onkeyup="">
						</div>
						<button type="submit" class="btn btn-primary mb-2">Search</button>
					</form>
				</h3>
				
				<button type="button" class="btn btn-primary">Google</button>
				<button type="button" class="btn btn-info">Bing!</button>
				<button type="button" class="btn btn-dark">Ask.com</button>
				<button type="button" class="btn btn-success">Yahoo</button>
				<button type="button" class="btn btn-danger">Yandex</button>
				<button type="button" class="btn btn-warning">DuckDuckGo</button>

				<p class="lead" style="padding-top:50px;">An open source search initiative which focuses on your privacy. We get results from above mentioned search engines on your behalf so that they can't track you.</p>

				<blockquote class="blockquote text-right">
				<p class="mb-0">No one should be a gate keeper on the greatest invention of our time i.e. Web</p>
				<footer class="blockquote-footer">Someone famous in <cite title="World">World</cite></footer>
				</blockquote>
			</div>
		</header>
	</body>
<html>
