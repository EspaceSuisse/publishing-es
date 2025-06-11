#target photoshop

// Main function
function main() {
    if (!app.documents.length) {
        alert("No open document.");
        return;
    }
    
    var doc = app.activeDocument;
    var originalName = doc.name.replace(/\.[^\.]+$/, ''); // remove extension
    
    // Resize so longer edge = 2400 px
    var w = doc.width.as('px');
    var h = doc.height.as('px');
    var maxEdge = 2400;
    
    if (w > h) {
        if (w > maxEdge) doc.resizeImage(UnitValue(maxEdge, 'px'), null, null, ResampleMethod.BICUBIC);
    } else {
        if (h > maxEdge) doc.resizeImage(null, UnitValue(maxEdge, 'px'), null, ResampleMethod.BICUBIC);
    }
    
    // Ask user for output folder
    var outputFolder = Folder.selectDialog("Select output folder");
    if (outputFolder == null) {
        alert("No output folder selected. Script canceled.");
        return;
    }
    
    // Determine file extension and save accordingly
    var ext = doc.name.split('.').pop().toLowerCase();
    
    if (ext == 'jpg' || ext == 'jpeg') {
        saveJPEG(doc, outputFolder, originalName, 60);
    } else if (ext == 'png') {
        savePNG(doc, outputFolder, originalName);
    } else {
        alert("Unsupported file format: " + ext);
    }
}

// Save as JPEG with quality setting
function saveJPEG(doc, folder, baseName, qualityPercent) {
    var saveFile = new File(folder.fsName + "/" + baseName + ".jpg");

    var psQuality = Math.round((qualityPercent / 100) * 12);
    if (psQuality > 12) psQuality = 12;

    var opts = new JPEGSaveOptions();
    opts.quality = psQuality;
    opts.formatOptions = FormatOptions.STANDARDBASELINE;
    opts.embedColorProfile = true;
    opts.matte = MatteType.NONE;
    doc.saveAs(saveFile, opts, true);
}

// Save as PNG
function savePNG(doc, folder, baseName) {
    var saveFile = new File(folder.fsName + "/" + baseName + ".png");
    var opts = new PNGSaveOptions();
    doc.saveAs(saveFile, opts, true);
}

main();
