<template>
	<div id="app" class="container mt-4">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-4 float-left">
					<div class="card" style="opacity: 0.95;">
						<h5 class="card-header">Tambah Data Prodi</h5>
						<div class="card-body">
							<form @submit.prevent="addItem">
								<div class="form-group">
									<label for="nama_prodi">Nama</label>
									<input type="text" id="nama_prodi" name="nama_prodi" class="form-control" v-model="nama_prodi" :disabled="validated == 1">
									<span v-if="er.nama_prodi" :class="['text-danger']">{{ er.nama_prodi[0] }}</span>
								</div>

								<div class="form-group">
									<label for="akreditas">Akreditas</label>
									<input type="text" id="akreditas" name="akreditas" class="form-control" v-model="akreditas">
									<span v-if="er.akreditas" :class="['text-danger']">{{ er.akreditas[0] }}</span>
								</div>

								<div class="from-group">
									<button class="btn btn-primary" type="submit" name="simpan" v-if="!edit"><i class="fas fa-save"></i> Simpan</button>
								</div>
							</form>
							<button class="btn btn-primary" type="submit" name="ubah" v-if="edit" @click="editItem(id)"><i class="fas fa-sync-alt"></i> Perbarui</button>
							<button class="btn btn-danger" type="submit" name="batal" v-if="edit" @click="balik()"><i class="fas fa-times-circle"></i> Batal</button>
						</div>
					</div>
				</div>
				<div class="col-md-8 float-right">
					<div class="card" style="opacity: 0.95;">
						<h5 class="card-header">Data Prodi</h5>

						<span v-if="tambah" :class="['text-center alert alert-success mt-3']">Data berhasil ditambahkan!</span>

						<span v-if="ubah" :class="['text-center alert alert-success mt-3']">Data berhasil diubah!</span>

						<span v-if="hapus" :class="['text-center alert alert-success mt-3']">Data berhasil dihapus!</span>

						<span v-if="fail" :class="['text-center alert alert-danger mt-3']">Hapus data relasi terlebih dahulu!</span>

						<div class="card-body">

							<table class="table table-striped">
								<tr>
									<th>NO</th>
									<th>Nama</th>
									<th>Akreditas</th>
							
									<th>Aksi</th>
								</tr>
								<tr v-for="(item, index) in results">
									<td>{{index + 1}}</td>
									<td>{{item.nama_prodi}}</td>
									<td>{{item.akreditas}}</td>
								
									<td>
										<button class="btn btn-success" @click="showItem(item.id)"><i class="fas fa-edit"></i></button>
										<button class="btn btn-danger" @click="removeItem(item.id)"><i class="fas fa-trash-alt"></i></button>
									</td>
								</tr>
							</table>
						</div>
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
				results: [],
				er: [],
				validated: false,
				tambah : false,    
				ubah : false,    
				hapus : false,
				fail : false,
				edit: false
			}
		},
		methods: {
			clearForm() {
				this.nama_prodi = '',
				this.akreditas = ''
			},
			balik() {
				this.clearForm(),
				this.validated = false;
				this.edit = false
			},
			getItem() {
				axios.get("/api/prodi")
				.then(
					response => {this.results = response.data.item},  
					)
				.catch(e => {
					this.errors.push(e)
				});
			},
			showItem(id) {
				this.edit = true
				axios.get("/api/prodi/" + id)
				.then(
					response => {
						this.id = response.data.item.id,
						this.nama_prodi = response.data.item.nama_prodi,
						this.akreditas = response.data.item.akreditas,
						this.validated = true;
					},  
					)
				.catch(e => {
					(error) => console.log(error)
				});
			},
			editItem(id) {
				axios.put("/api/prodi/" + id, {
					nama_prodi: this.nama_prodi,
					akreditas: this.akreditas
				})
				.then(
					(response => {
						this.clearForm(),
						this.er = [];
						this.getItem(),
						this.edit = false;
						this.validated = false;
						this.tambah = false;
						this.hapus = false;
						this.fail = false;
						this.ubah = true;
					})
					)
				.catch(
					(error) => {console.log(error),
						this.er = error.response.data.errors;
					});
			},
			removeItem(id) {
				const confirmBox = confirm("Anda yakin ingin menghapus?")
				if(confirmBox)
					axios.delete("/api/prodi/" + id)
				.then(
					(response => {
						this.getItem(),
						this.tambah = false;
						this.ubah = false;
						this.fail = false;
						this.hapus = true;
					})
					)
				.catch(
					(error) => this.fail = true
					);
			},
			addItem() {
				axios.post("/api/prodi", {
					nama_prodi: this.nama_prodi,
					akreditas: this.akreditas
				})
				.then(
					(response => {
						this.clearForm(),
						this.er = [];
						this.getItem(),
						this.ubah = false;
						this.hapus = false;
						this.fail = false;
						this.tambah = true;
					})
					)
				.catch(
					(error) => {console.log(error),
						this.er = error.response.data.errors;
					});
			}

		},
		mounted() {
			this.getItem()
		}
	}
</script>