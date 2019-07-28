<template>
	<div id="app" class="container mt-4">
		<div class="row">
			<div class="col-md-12">
				
				<div class="card" style="opacity: 0.95;">
					<h5 class="card-header">Data Prodi</h5>

					<div class="card-body">

						<table class="table table-striped">
							<tr>
								<th>NO</th>
								<th>Nama</th>
								<th>Akreditas</th>

							</tr>
							<tr v-for="(item, index) in results">
								<td>{{index + 1}}</td>
								<td>{{item.nama_prodi}}</td>
								<td>{{item.akreditas}}</td>
								
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import axios from 'axios';
	export default {
		data () {
			return {
				id: '',
				nama_prodi: '',
				akreditas: '',
				results: []
			}
		},
		methods: {
			
			getItem() {
				axios.get("/prodi")
				.then(
					response => {this.results = response.data.item},  
					)
				.catch(e => {
					this.errors.push(e)
				});
			}

		},
		mounted() {
			this.getItem()
		}
	}
</script>