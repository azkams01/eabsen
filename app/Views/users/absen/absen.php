<?php echo $this->extend('/layout/tamplate'); ?>

<?php echo $this->section('content'); ?>
<?php

if (akunSiswa()->Email == "") {
    echo "
      <script>
      Swal.fire(
        'Eitss !!',
        'Isi Data Profil Dulu Ya Kids :)',
        'error'
      ).then((result) => {
        if (result.value == true) {
          document.location.href = '/users/profil'
        }
        document.location.href = '/users/profil'
      })
      </script>
    ";
}
?>
<?php echo $this->endSection(); ?>