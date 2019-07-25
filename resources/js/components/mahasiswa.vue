<template>
	<div id="app" class="container mt-4">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-4 float-left">
					<div class="card" style="opacity: 0.95;">
						<h5 class="card-header">Tambah Data Mahasiswa</h5>
						<div class="card-body">
							<form @submit.prevent="addItem">
								<div :class="['form-group', { 'has-error' : errors.nim }]">
									<label for="nim">NIM</label>
									<input type="text" id="nim" name="nim" class="form-control" v-model="nim">
									<span v-if="errors.nim" class="label label-danger">
										{{ errors.nim[0] }}
									</span>
								</div>
								<div class="form-group">
									<label for="nama_mahasiswa">Nama</label>
									<input type="text" id="nama_mahasiswa" name="nama_mahasiswa" class="form-control" v-model="nama_mahasiswa">
								</div>

								<div class="form-group">
									<label for="pendidikan">Pendidikan</label>
									<input type="text" id="pendidikan" name="pendidikan" class="form-control" v-model="pendidikan">
								</div>

								<div class="form-group">
									<label for="alamat_mahasiswa">Alamat</label>
									<input type="text" id="alamat_mahasiswa" name="alamat_mahasiswa" class="form-control" v-model="alamat_mahasiswa">
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
						<h5 class="card-header">Data Mahasiswa</h5>
						<div class="card-body">


							<table class="table table-striped mt-3">
								<tr>
									<th>NO</th>
									<th>NIM</th>
									<th>Nama</th>
									<th>Pendidikan</th>
									<th>Alamat</th>
									<th>Aksi</th>
								</tr>
								<tr v-for="(item, index) in results">
									<td>{{index + 1}}</td>
									<td>{{item.nim}}</td>
									<td>{{item.nama_mahasiswa}}</td>
									<td>{{item.pendidikan}}</td>
									<td>{{item.alamat_mahasiswa}}</td>
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
				nim: '',
				nama_mahasiswa: '',
				pendidikan: '',
				alamat_mahasiswa: '',
				alert: {},
				results: [],
				errors: [],
				edit: false
			}
		},
		methods: {
			submit(e) {
				this.errors = [];
				this.alert = {};
				axios.post(e.target.action, this.state).then(response => {
					if (response.data.status) {
						this.alert = {
							type: 'success',
							message: response.data.message
						}
						this.errors = [];
					}
				}).catch(error => {
					if (error) {
						if (error.response.status == 422) {
							this.errors = error.response.data;
						}
					}
				});
			},
			clearForm() {
				this.nim = '',
				this.nama_mahasiswa = '',
				this.pendidikan = '',
				this.alamat_mahasiswa = ''
			},
			balik() {
				this.clearForm(),
				this.edit = false
			},
			getItem() {
				axios.get("/api/mahasiswa")
				.then(
					response => {this.results = response.data.item},  
					)
				.catch(e => {
					this.errors.push(e)
				});
			},
			showItem(id) {
				this.edit = true
				axios.get("/api/mahasiswa/" + id)
				.then(
					response => {
						this.id = response.data.item.id,
						this.nim = response.data.item.nim,
						this.nama_mahasiswa = response.data.item.nama_mahasiswa,
						this.pendidikan = response.data.item.pendidikan,
						this.alamat_mahasiswa = response.data.item.alamat_mahasiswa

					},  
					)
				.catch(e => {
					(error) => console.log(error)
				});
			},
			editItem(id) {
				axios.put("/api/mahasiswa/" + id, {
					nim: this.nim,
					nama_mahasiswa: this.nama_mahasiswa,
					pendidikan: this.pendidikan,
					alamat_mahasiswa: this.alamat_mahasiswa
				})
				.then(
					(response => {
						this.clearForm(),
						this.getItem(),
						this.edit = false
					})
					)
				.catch(
					(error) => console.log(error)
					);
			},
			removeItem(id) {
				const confirmBox = confirm("Anda yakin ingin menghapus?")
				if(confirmBox)
					axios.delete("/api/mahasiswa/" + id)
				.then(
					(response => {
						this.getItem()
					})
					)
				.catch(
					(error) => console.log(error)
					);
			},
			addItem() {
				axios.post("/api/mahasiswa", {
					nim: this.nim,
					nama_mahasiswa: this.nama_mahasiswa,
					pendidikan: this.pendidikan,
					alamat_mahasiswa: this.alamat_mahasiswa
				})
				.then(
					(response => {
						this.clearForm(),
						this.getItem()
					})
					)
				.catch(
					(error) => console.log(error)
					);
			}

		},
		mounted() {
			this.getItem()
		}
	}
</script>