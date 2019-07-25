<template>
	<div id="app" class="container mt-4">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-4 float-left">
					<div class="card" style="opacity: 0.95;">
						<h5 class="card-header">Tambah Data Dosen</h5>
						<div class="card-body">
							<form @submit.prevent="addItem">
								<div class="form-group">
									<label for="nik">NIK</label>
									<input type="text" id="nik" name="nik" class="form-control" v-model="nik">
								</div>

								<div class="form-group">
									<label for="nama_dosen">Nama</label>
									<input type="text" id="nama_dosen" name="nama_dosen" class="form-control" v-model="nama_dosen">
								</div>

								<div class="form-group">
									<label for="pendidikan">Pendidikan</label>
									<input type="text" id="pendidikan" name="pendidikan" class="form-control" v-model="pendidikan">
								</div>

								<div class="form-group">
									<label for="alamat_dosen">Alamat</label>
									<input type="text" id="alamat_dosen" name="alamat_dosen" class="form-control" v-model="alamat_dosen">
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
						<h5 class="card-header">Data Dosen</h5>
						<div class="card-body">

							<table class="table table-striped mt-3">
								<tr>
									<th>NO</th>
									<th>NIK</th>
									<th>Nama</th>
									<th>Pendidikan</th>
									<th>Alamat</th>
									<th>Aksi</th>
								</tr>
								<tr v-for="(item, index) in results">
									<td>{{index + 1}}</td>
									<td>{{item.nik}}</td>
									<td>{{item.nama_dosen}}</td>
									<td>{{item.pendidikan}}</td>
									<td>{{item.alamat_dosen}}</td>
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
				nik: '',
				nama_dosen: '',
				pendidikan: '',
				alamat_dosen: '',
				results: [],
				edit: false
			}
		},
		methods: {
			clearForm() {
				this.nik = '',
				this.nama_dosen = '',
				this.pendidikan = '',
				this.alamat_dosen = ''
			},
			balik() {
				this.clearForm(),
				this.edit = false
			},
			getItem() {
				axios.get("/api/dosen")
				.then(
					response => {this.results = response.data.item},  
					)
				.catch(e => {
					this.errors.push(e)
				});
			},
			showItem(id) {
				this.edit = true
				axios.get("/api/dosen/" + id)
				.then(
					response => {
						this.id = response.data.item.id,
						this.nik = response.data.item.nik,
						this.pendidikan = response.data.item.pendidikan,
						this.nama_dosen = response.data.item.nama_dosen,
						this.alamat_dosen = response.data.item.alamat_dosen

					},  
					)
				.catch(e => {
					(error) => console.log(error)
				});
			},
			editItem(id) {
				axios.put("/api/dosen/" + id, {
					nik: this.nik,
					nama_dosen: this.nama_dosen,
					pendidikan: this.pendidikan,
					alamat_dosen: this.alamat_dosen
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
				const confirmBox = confirm("Are you sure want remove?")
				if(confirmBox)
					axios.delete("/api/dosen/" + id)
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
				axios.post("/api/dosen", {
					nik: this.nik,
					nama_dosen: this.nama_dosen,
					pendidikan: this.pendidikan,
					alamat_dosen: this.alamat_dosen
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