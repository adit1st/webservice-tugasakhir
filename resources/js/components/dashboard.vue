

<template>
   <div id="app" class="container mt-4">
		<div class="row">
			<div class="col-md-10 offset-md-1">
				<div class="jumbotron"  style="opacity: 0.95;">
					<h1 class="display-4">Selamat Datang!</h1>
					<p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
					<hr class="my-4">
					<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
					<a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
				</div>
			</div>
		</div>
	</div>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>