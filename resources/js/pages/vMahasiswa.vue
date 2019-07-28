<template>
	<div id="app" class="container mt-4">
		<div class="row">
			<div class="col-md-12">
				
				<div class="card" style="opacity: 0.95;">
					<h5 class="card-header">Data Mahasiswa</h5>

					<div class="card-body">

						<table class="table table-striped">
							<tr>
								<th>NO</th>
								<th>NIM</th>
								<th>Nama</th>
								<th>Prodi</th>
								<th>Alamat</th>
								
							</tr>
							<tr v-for="(item, index) in results">
								<td>{{index + 1}}</td>
								<td>{{item.nim}}</td>
								<td>{{item.nama_mahasiswa}}</td>
								<td>{{item.prodi.nama_prodi}}</td>
								<td>{{item.alamat_mahasiswa}}</td>
								
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
				nim: '',
				nama_mahasiswa: '',
				prodi_id: '',
				alamat_mahasiswa: '',
				results: []
			}
		},
		methods: {
		
			getItem() {
				axios.get("/mahasiswa")
				.then(
					response => {this.results = response.data.item, this.r = response.data.item2},  
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