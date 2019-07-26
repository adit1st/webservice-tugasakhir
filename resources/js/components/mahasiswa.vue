<template>
	<div id="app" class="container mt-4">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-4 float-left">
					<div class="card" style="opacity: 0.95;">
						<h5 class="card-header">Tambah Data Mahasiswa</h5>
						<div class="card-body">
							<form @submit.prevent="addItem">

								<div class="form-group">
									<label for="nim">NIM</label>
									<input type="text" id="nim" name="nim" class="form-control" v-model="nim" :disabled="validated == 1">
									<span v-if="er.nim" :class="['text-danger']">{{ er.nim[0] }}</span>
								</div>

								<div class="form-group">
									<label for="nama_mahasiswa">Nama</label>
									<input type="text" id="nama_mahasiswa" name="nama_mahasiswa" class="form-control" v-model="nama_mahasiswa">
									<span v-if="er.nama_mahasiswa" :class="['text-danger']">{{ er.nama_mahasiswa[0] }}</span>
								</div>

								<div class="form-group">
									<label for="prodi_id">Prodi</label>
									<select class="form-control" name="prodi_id" id="prodi_id" v-model="prodi_id">
										<option v-for="item in r" :value="item.id">
										{{item.nama_prodi}}</option>
									</select>
									<span v-if="er.prodi_id" :class="['text-danger']">{{ er.prodi_id[0] }}</span>
								</div>

								<div class="form-group">
									<label for="alamat_mahasiswa">Alamat</label>
									<textarea class="form-control" id="alamat_mahasiswa" nama="alamat_mahasiswa" rows="3" v-model="alamat_mahasiswa"></textarea>
									<span v-if="er.alamat_mahasiswa" :class="['text-danger']">{{ er.alamat_mahasiswa[0] }}</span>
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
						
						<span v-if="tambah" :class="['text-center alert alert-success mt-3']">Data Berhasil Ditambahkan!</span>

						<span v-if="ubah" :class="['text-center alert alert-success mt-3']">Data Berhasil Diubah!</span>

						<span v-if="hapus" :class="['text-center alert alert-success mt-3']">Data Berhasil Dihapus!</span>
						
						<div class="card-body">

							<table class="table table-striped">
								<tr>
									<th>NO</th>
									<th>NIM</th>
									<th>Nama</th>
									<th>Prodi</th>
									<th>Alamat</th>
									<th>Aksi</th>
								</tr>
								<tr v-for="(item, index) in results">
									<td>{{index + 1}}</td>
									<td>{{item.nim}}</td>
									<td>{{item.nama_mahasiswa}}</td>
									<td>{{item.prodi.nama_prodi}}</td>
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
				prodi_id: '',
				alamat_mahasiswa: '',
				er: [],
				results: [],
				r: [],
				validated: false,
				tambah : false,    
				ubah : false,    
				hapus : false,    
				edit: false
			}
		},
		methods: {
			clearForm() {
				this.nim = '',
				this.nama_mahasiswa = '',
				this.prodi_id = '',
				this.alamat_mahasiswa = ''
			},
			balik() {
				this.clearForm(),
				this.validated = false;
				this.edit = false
			},
			getItem() {
				axios.get("/api/mahasiswa")
				.then(
					response => {this.results = response.data.item, this.r = response.data.item2},  
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
						this.prodi_id = response.data.item.prodi_id,
						this.alamat_mahasiswa = response.data.item.alamat_mahasiswa,
						this.validated = true;
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
					prodi_id: this.prodi_id,
					alamat_mahasiswa: this.alamat_mahasiswa
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
					axios.delete("/api/mahasiswa/" + id)
				.then(
					(response => {
						this.getItem(),
						this.tambah = false;
						this.ubah = false;
						this.hapus = true;
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
					prodi_id: this.prodi_id,
					alamat_mahasiswa: this.alamat_mahasiswa
				})
				.then(
					(response => {
						this.clearForm(),
						this.er = [];
						this.getItem(),
						this.ubah = false;
						this.hapus = false;
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