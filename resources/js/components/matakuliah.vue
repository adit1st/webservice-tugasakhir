<template>
	<div id="app" class="container mt-4">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-4 float-left">
					<div class="card" style="opacity: 0.95;">
						<h5 class="card-header">Tambah Data Matakuliah</h5>
						<div class="card-body">
							<form @submit.prevent="addItem">
								<div class="form-group">
									<label for="kode_matakuliah">Kode</label>
									<input type="text" id="kode_matakuliah" name="kode_matakuliah" class="form-control" v-model="kode_matakuliah" :disabled="validated == 1">
									<span v-if="er.kode_matakuliah" :class="['text-danger']">{{ er.kode_matakuliah[0] }}</span>
								</div>

								<div class="form-group">
									<label for="nama_matakuliah">Nama</label>
									<input type="text" id="nama_matakuliah" name="nama_matakuliah" class="form-control" v-model="nama_matakuliah">
									<span v-if="er.nama_matakuliah" :class="['text-danger']">{{ er.nama_matakuliah[0] }}</span>
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
									<label for="dosen_id">Dosen Pengampu</label>
									<select class="form-control" name="dosen_id" id="dosen_id" v-model="dosen_id">
											<option v-for="item in rs" :value="item.id">
												{{item.nama_dosen}}</option>
									</select>
									<span v-if="er.dosen_id" :class="['text-danger']">{{ er.dosen_id[0] }}</span>
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
						<h5 class="card-header">Data Matakuliah</h5>

						<span v-if="tambah" :class="['text-center alert alert-success mt-3']">Data berhasil ditambahkan!</span>

						<span v-if="ubah" :class="['text-center alert alert-success mt-3']">Data berhasil diubah!</span>

						<span v-if="hapus" :class="['text-center alert alert-success mt-3']">Data berhasil dihapus!</span>

						<div class="card-body">

							<table class="table table-striped">
								<tr>
									<th>NO</th>
									<th>KODE</th>
									<th>Nama</th>
									<th>Prodi</th>
									<th>Dosen Pengampu</th>

									<th>Aksi</th>
								</tr>
								<tr v-for="(item, index) in results">
									<td>{{index + 1}}</td>
									<td>{{item.kode_matakuliah}}</td>
									<td>{{item.nama_matakuliah}}</td>
									<td>{{item.prodi.nama_prodi}}</td>
									<td>{{item.dosen.nama_dosen}}</td>
									


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
				kode_matakuliah: '',
				nama_matakuliah: '',
				prodi_id: '',
				dosen_id: '',	
				results: [],
				rs: [],
				r:[],
				er: [],
				validated: false,
				tambah : false,    
				ubah : false,    
				hapus : false,
				edit: false
			}
		},

		methods: {
			clearForm() {
				this.kode_matakuliah = '',
				this.nama_matakuliah = '',
				this.prodi_id = '',
				this.dosen_id = ''

			},
			balik() {
				this.clearForm(),
				this.validated = false;
				this.edit = false
			},
			getItem() {
				axios.get("/api/matakuliah")
				.then(
					response => {this.results = response.data.item, 
						this.rs = response.data.item2, 
						this.r = response.data.item3},  
					
					)
				.catch(e => {
					this.errors.push(e)
				});
			},
			showItem(id) {
				this.edit = true
				axios.get("/api/matakuliah/" + id)
				.then(
					response => {
						this.id = response.data.item.id,
						this.kode_matakuliah = response.data.item.kode_matakuliah,
						this.nama_matakuliah = response.data.item.nama_matakuliah,
						this.prodi_id = response.data.item.prodi_id,
						this.dosen_id = response.data.item.dosen_id,
						this.validated = true;
					},  
					)
				.catch(e => {
					(error) => console.log(error)
				});
			},
			editItem(id) {
				axios.put("/api/matakuliah/" + id, {
					kode_matakuliah: this.kode_matakuliah,
					nama_matakuliah: this.nama_matakuliah,
					prodi_id: this.prodi_id,
					dosen_id: this.dosen_id
					
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
					axios.delete("/api/matakuliah/" + id)
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
				axios.post("/api/matakuliah", {
					kode_matakuliah: this.kode_matakuliah,
					nama_matakuliah: this.nama_matakuliah,
					prodi_id: this.prodi_id,
					dosen_id: this.dosen_id

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