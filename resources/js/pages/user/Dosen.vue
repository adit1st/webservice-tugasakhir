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
									<input type="text" id="nik" name="nik" class="form-control" v-model="nik" :disabled="validated == 1">
									<span v-if="er.nik" :class="['text-danger']">{{ er.nik[0] }}</span>
								</div>

								<div class="form-group">
									<label for="nama_dosen">Nama</label>
									<input type="text" id="nama_dosen" name="nama_dosen" class="form-control" v-model="nama_dosen">
									<span v-if="er.nama_dosen" :class="['text-danger']">{{ er.nama_dosen[0] }}</span>
								</div>

								<div class="form-group">
									<label for="pendidikan">Pendidikan Terakhir</label>
									<input type="text" id="pendidikan" name="pendidikan" class="form-control" v-model="pendidikan">
									<span v-if="er.pendidikan" :class="['text-danger']">{{ er.pendidikan[0] }}</span>
								</div>

								<div class="form-group">
									<label for="alamat_dosen">Alamat</label>
									<textarea class="form-control" id="alamat_dosen" nama="alamat_dosen" rows="3" v-model="alamat_dosen"></textarea>
									<span v-if="er.alamat_dosen" :class="['text-danger']">{{ er.alamat_dosen[0] }}</span>
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

						<span v-if="tambah" :class="['text-center alert alert-success mt-3']">Data berhasil ditambahkan!</span>

						<span v-if="ubah" :class="['text-center alert alert-success mt-3']">Data berhasil diubah!</span>

						<span v-if="hapus" :class="['text-center alert alert-success mt-3']">Data berhasil dihapus!</span>

						<span v-if="fail" :class="['text-center alert alert-danger mt-3']">Hapus data relasi terlebih dahulu!</span>

						<div class="card-body">

							<table class="table table-striped">
								<tr>
									<th>NO</th>
									<th>NIK</th>
									<th>Nama</th>
									<th>Pendidikan Terakhir</th>
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
				this.nik = '',
				this.nama_dosen = '',
				this.pendidikan = '',
				this.alamat_dosen = ''
			},
			balik() {
				this.clearForm(),
				this.validated = false;
				this.edit = false
			},
			getItem() {
				axios.get("/dosen")
				.then(
					response => {this.results = response.data.item},  
					)
				.catch(e => {
					this.errors.push(e)
				});
			},
			showItem(id) {
				this.edit = true
				axios.get("/dosen/" + id)
				.then(
					response => {
						this.id = response.data.item.id,
						this.nik = response.data.item.nik,
						this.pendidikan = response.data.item.pendidikan,
						this.nama_dosen = response.data.item.nama_dosen,
						this.alamat_dosen = response.data.item.alamat_dosen,
						this.validated = true;
					},  
					)
				.catch(e => {
					(error) => console.log(error)
				});
			},
			editItem(id) {
				axios.put("/dosen/" + id, {
					nik: this.nik,
					nama_dosen: this.nama_dosen,
					pendidikan: this.pendidikan,
					alamat_dosen: this.alamat_dosen
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
					axios.delete("/dosen/" + id)
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
				axios.post("/dosen", {
					nik: this.nik,
					nama_dosen: this.nama_dosen,
					pendidikan: this.pendidikan,
					alamat_dosen: this.alamat_dosen
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