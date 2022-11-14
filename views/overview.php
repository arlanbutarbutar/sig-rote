<?php require_once("../controller/script.php"); ?>

<div class="row">
  <div class="col-sm-12 mt-3 m-0 p-0">
    <div class="statistics-details d-flex align-items-center justify-content-between">
      <div class="rounded-0 p-4 m-3 ml-0 w-100 shadow" style="background-color: #7ab730;">
        <p class="statistics-title text-white">Kategori Fasilitas</p>
        <h3 class="rate-percentage text-white"><?= $countKFasilitas; ?></h3>
        <p class="text-danger d-flex">
          <a href="kategori-fasilitas" class="text-white text-decoration-none">
            <i class="mdi mdi-eye"></i><span> Lihat</span>
          </a>
        </p>
      </div>
      <div class="rounded-0 p-4 m-3 w-100 shadow" style="background-color: #7ab730;">
        <p class="statistics-title text-white">Kategori Wisata</p>
        <h3 class="rate-percentage text-white"><?= $countKWisata; ?></h3>
        <p class="text-danger d-flex">
          <a href="kategori-wisata" class="text-white text-decoration-none">
            <i class="mdi mdi-eye"></i><span> Lihat</span>
          </a>
        </p>
      </div>
      <div class="rounded-0 p-4 m-3 w-100 shadow" style="background-color: #7ab730;">
        <p class="statistics-title text-white">Fasilitas</p>
        <h3 class="rate-percentage text-white"><?= $countFasilitas; ?></h3>
        <p class="text-danger d-flex">
          <a href="fasilitas" class="text-white text-decoration-none">
            <i class="mdi mdi-eye"></i><span> Lihat</span>
          </a>
        </p>
      </div>
      <div class="rounded-0 p-4 m-3 w-100 shadow" style="background-color: #7ab730;">
        <p class="statistics-title text-white">Wisata</p>
        <h3 class="rate-percentage text-white"><?= $countWisata; ?></h3>
        <p class="text-danger d-flex">
          <a href="wisata" class="text-white text-decoration-none">
            <i class="mdi mdi-eye"></i><span> Lihat</span>
          </a>
        </p>
      </div>
    </div>
  </div>
</div>
<div class="row" id="pemesanan">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card rounded-0 shadow" style="margin-top: -40px;">
      <div class="card-body">
        <div class="d-sm-flex justify-content-between align-items-start">
          <div>
            <h4 class="card-title card-title-dash">Tempat Wisata</h4>
            <p class="card-subtitle card-subtitle-dash">Lihat semua tempat wisata Rote Ndao</p>
          </div>
        </div>
        <div class="table-responsive mt-1">
          <table class="table select-table table-sm table-striped table-borderless">
            <thead class="text-center">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Wisata</th>
                <th scope="col">Kategori</th>
                <th scope="col">Fasilitas</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Alamat</th>
                <th scope="col">Tgl buat</th>
                <th scope="col">Tgl ubah</th>
                <th scope="col" colspan="3">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (mysqli_num_rows($wisataOverview) == 0) { ?>
                <tr>
                  <th scope="row" colspan="11">belum ada data wisata</th>
                </tr>
                <?php } else if (mysqli_num_rows($wisataOverview) > 0) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($wisataOverview)) { ?>
                  <tr>
                    <th scope="row"><?= $no; ?></th>
                    <td>
                      <div class="d-flex">
                        <img src="../assets/images/wisata/<?= $row['image'] ?>" alt="">
                        <div class="my-auto">
                          <h6 style="margin-left: 10px;"><?= $row['nama_wisata'] ?></h6>
                        </div>
                      </div>
                    </td>
                    <td><?= $row['nama_kwisata'] ?></td>
                    <td><?= $row['nama_fasilitas'] ?></td>
                    <td>
                      <button type="button" class="btn btn-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#deskripsi<?= $row['id_wisata'] ?>">
                        Lihat
                      </button>
                      <div class="modal fade" id="deskripsi<?= $row['id_wisata'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header border-bottom-0 shadow">
                              <h5 class="modal-title" id="exampleModalLabel">Deskripsi <?= $row['nama_wisata'] ?></h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <textarea class="form-control border-0" id="message-text" style="height: 300px;">
                                        <?= $row['deskripsi'] ?>
                                      </textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td><?= $row['alamat'] ?></td>
                    <td>
                      <div class="badge badge-opacity-success">
                        <?php $dateCreate = date_create($row['created_at']);
                        echo date_format($dateCreate, "l, d M Y h:i a"); ?>
                      </div>
                    </td>
                    <td>
                      <div class="badge badge-opacity-warning">
                        <?php $dateUpdate = date_create($row['updated_at']);
                        echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
                      </div>
                    </td>
                    <td>
                      <a href="galeri?id=<?= $row['id_wisata'] ?>" class="btn btn-info btn-sm rounded-0"><i class="bi bi-eye"></i> Galeri</a>
                    </td>
                    <td>
                      <a href="lokasi?id=<?= $row['id_wisata'] ?>" class="btn btn-info btn-sm rounded-0"><i class="bi bi-eye"></i> Lokasi</a>
                    </td>
                    <td>
                      <a href="edit-wisata?id=<?= $row['id_wisata'] ?>" class="btn btn-warning btn-sm rounded-0"><i class="bi bi-pencil-square"></i></a>
                    </td>
                    <td>
                      <button type="button" class="btn btn-danger btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_wisata'] ?>">
                        <i class="bi bi-trash3"></i>
                      </button>
                      <div class="modal fade" id="hapus<?= $row['id_wisata'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header border-bottom-0 shadow">
                              <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row['nama_wisata'] ?></h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Anda yakin ingin menghapus wisata <?= $row['nama_wisata'] ?> ini?
                            </div>
                            <div class="modal-footer justify-content-center border-top-0">
                              <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                              <form action="" method="POST">
                                <input type="hidden" name="id" value="<?= $row['id_wisata'] ?>">
                                <input type="hidden" name="namaOld" value="<?= $row['nama_wisata'] ?>">
                                <input type="hidden" name="imageOld" value="<?= $row['image'] ?>">
                                <button type="submit" name="hapus-wisata" class="btn btn-danger btn-sm rounded-0">Hapus</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
              <?php $no++;
                }
              } ?>
            </tbody>
          </table>
          <?php if (mysqli_num_rows($wisataOverview) == 25) { ?>
            <a href="wisata" class="nav-link text-decoration-none mt-3" style="text-align: right;color: #7ab730;">lihat semua Wisata</a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>