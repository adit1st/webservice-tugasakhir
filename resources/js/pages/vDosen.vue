<template>
	<div id="app" class="container mt-4">
		<div class="row">
			<div class="col-md-12">
				
				<div class="card" style="opacity: 0.95;">
					<h5 class="card-header">Data Dosen</h5>


					<div class="card-body">

						<table class="table table-striped">
							<tr>
								<th>NO</th>
								<th>NIK</th>
								<th>Nama</th>
								<th>Pendidikan Terakhir</th>
								<th>Alamat</th>

							</tr>
							<tr v-for="(item, index) in results">
								<td>{{index + 1}}</td>
								<td>{{item.nik}}</td>
								<td>{{item.nama_dosen}}</td>
								<td>{{item.pendidikan}}</td>
								<td>{{item.alamat_dosen}}</td>

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
				nik: '',
				nama_dosen: '',
				pendidikan: '',
				alamat_dosen: '',
				results: []
			}
		},
		methods: {
			
			getItem() {
				axios.get("/dosen")
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