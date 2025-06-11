#target photoshop

function main() {
    if (!app.documents.length) {
        alert("No open document.");
        return;
    }

    var doc = app.activeDocument;
    var originalFile = doc.fullName; // full path
    var fileExt = doc.name.split('.').pop().toLowerCase();
    var baseName = doc.name.replace(/\.[^\.]+$/, '');

    // Resize the longer edge to 2400px
    var w = doc.width.as('px');
    var h = doc.height.as('px');
    var maxEdge = 2400;

    if (w > h) {
        if (w > maxEdge) doc.resizeImage(UnitValue(maxEdge, 'px'), null, null, ResampleMethod.BICUBIC);
    } else {
        if (h > maxEdge) doc.resizeImage(null, UnitValue(maxEdge, 'px'), null, ResampleMethod.BICUBIC);
    }

    // Save over the original file
    if (fileExt == 'jpg' || fileExt == 'jpeg') {
        saveJPEG(doc, originalFile, 6); // Quality 6 = ~60%
    } else if (fileExt == 'png') {
        savePNG(doc, originalFile);
    } else {
        alert("Unsupported file format: " + fileExt);
    }
}

function saveJPEG(doc, filePath, quality) {
    var file = new File(filePath);
    var opts = new JPEGSaveOptions();
    opts.quality = quality;
    opts.formatOptions = FormatOptions.STANDARDBASELINE;
    opts.embedColorProfile = true;
    opts.matte = MatteType.NONE;
    doc.saveAs(file, opts, true);
}

function savePNG(doc, filePath) {
    var file = new File(filePath);
    var opts = new PNGSaveOptions();
    doc.saveAs(file, opts, true);
}

main();
