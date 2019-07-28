<template>
	<div id="app" class="container mt-4">
		<div class="row">
			<div class="col-md-12">
				
				<div class="card" style="opacity: 0.95;">
					<h5 class="card-header">Data Matakuliah</h5>

					<div class="card-body">

						<table class="table table-striped">
							<tr>
								<th>NO</th>
								<th>KODE</th>
								<th>Nama</th>
								<th>Prodi</th>
								<th>Dosen Pengampu</th>

							</tr>
							<tr v-for="(item, index) in results">
								<td>{{index + 1}}</td>
								<td>{{item.kode_matakuliah}}</td>
								<td>{{item.nama_matakuliah}}</td>
								<td>{{item.prodi.nama_prodi}}</td>
								<td>{{item.dosen.nama_dosen}}</td>

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
				kode_matakuliah: '',
				nama_matakuliah: '',
				prodi_id: '',
				dosen_id: '',	
				results: []
			}
		},

		methods: {
			
			getItem() {
				axios.get("/matakuliah")
				.then(
					response => {this.results = response.data.item, 
						this.rs = response.data.item2, 
						this.r = response.data.item3},  

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