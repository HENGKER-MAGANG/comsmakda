<!-- project.html -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Detail Project | COM SMAKDA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body class="bg-light">
  <div class="container py-5">
    <a href="index.html#portfolio" class="btn btn-secondary mb-4">← Kembali</a>
    <div id="project-detail" class="bg-white p-4 rounded shadow-sm"></div>
  </div>

  <script>
    const params = new URLSearchParams(window.location.search);
    const slug = params.get('id');

    fetch('data/projects.json')
      .then(res => res.json())
      .then(data => {
        const project = data.find(p => p.slug === slug);
        if (!project) return document.getElementById('project-detail').innerHTML = 'Project tidak ditemukan';

        document.title = `${project.nama} | COM SMAKDA`;

        document.getElementById('project-detail').innerHTML = `
          <h2>${project.nama}</h2>
          <p class="text-muted">${project.tahun}</p>
          <p>${project.deskripsi}</p>
          <h5>Teknologi yang Digunakan:</h5>
          <ul>${project.teknologi.map(tech => `<li>${tech}</li>`).join('')}</ul>
          <h5>Screenshot:</h5>
          <div class="row">
            ${project.gambar.map(gm => `
              <div class="col-md-4 mb-3">
                <img src="${gm}" class="img-fluid rounded" />
              </div>
            `).join('')}
          </div>
        `;
      });
  </script>
</body>
</html>
