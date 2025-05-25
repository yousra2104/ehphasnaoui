document.getElementById('downloadBtn').addEventListener('click', function() {
    const files = [
        '../assets/img/Politique QSE- EHPH AR.pdf',
        '../assets/img/Politique QSE- EHPH FR.pdf',
        '../assets/img/Politique QSE- EHPH EN.pdf'
    ];

    files.forEach(file => {
        const link = document.createElement('a');
        link.href = file;
        link.download = file.split('/').pop();
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });
});