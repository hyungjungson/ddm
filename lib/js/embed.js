function activeX(file, width, height) {
    document.write("<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0' width='" + width + "' height='" + height + "'><PARAM NAME=wmode VALUE=transparent><param name='movie' value='" + file + "'><param name='quality' value='high'><embed src='" + file + "' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='" + width + "' height='" + height + "'></embed></object>");
}

function swf(src, width, height) {
    object = '';
    object += '<object type="application/x-shockwave-flash" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="param" width="' + width + '" height="' + height + '">';
    object += '<param name="movie" value="' + src + '">';
    object += '<embed src="' + src + '" quality="high" wmode="transparent" bgcolor="#ffffff" menu="false" width="' + width + '" height="' + height + '" swliveconnect="true" id="param" name="param" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"><\/embed>';
    object += '<\/object>';
    document.write(object);
}

function embedObject(type, id, source, width, height) {
    this.type = type;
    this.id = id;
    this.source = source;
    this.width = width;
    this.height = height;
    this.objectParam = new String;
    this.embedparam = new String;

    if(this.id != '') {
        name = ' name="' + id + '"';
        id = ' id="' + id + '"';
    }

    switch (this.type) {
        case 'flash':
            this.objectParam = '<object' + id + ' CLASSID="CLSID:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="' + width + '" height="' + height + '">\n';
            this.objectParam += '<param name="movie" value="' + source + '">\n';
            this.embedParam = '<embed' + name + ' src="' + source + '" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" swLiveConnect="true" width="' + width + '" height="' + height + '" ';
            break;
        case 'media':
            this.objectParam = '<object' + id + ' CLASSID="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6" width="' + width + '" height="' + height + '" standby="Loading Microsoft Windows Media Player components...">\n';
            this.objectParam += '<param name="URL" value="' + source + '">\n';
            this.embedParam = '<embed' + name + ' src="' + source + '" type="application/x-mplayer2" width="' + width + '" height="' + height + '" ';
            break;
        default:
            this.objectParam = '<object' + id + '>\n';
            this.embedParam = '<embed' + name + ' ';
    }

    this.setParam = function(key, value) {
        this.objectParam += '<param name="' + key + '" value="' + value + '">\n';
        this.embedParam += ' ' + key + '="' + value + '" ';
    }

    this.show = function() {
        this.embedParam += '>\n';
        document.write(this.objectParam + this.embedParam + '</object>\n');
    }
}

function showFlash() {
    var params = showFlash.arguments;

    if(params[3]) {
        var id = params[3];
    } else {
        var id = '';
    }
    flashObject = new embedObject('flash', id, params[0], params[1], params[2]);
    flashObject.setParam('quality', 'high');
    flashObject.setParam('wmode', 'transparent');
    flashObject.setParam('allowScriptAccess', 'always');
    flashObject.show();
}

function showMedia(source, width, height) {
    mediaObject = new embedObject('media', 'MediaPlayer', source, width, height);
    mediaObject.setParam('stretchTofit', 'true');
    mediaObject.setParam('autostart', 'true');
    mediaObject.show();
}

function activeX(file, width, height) {
    document.write("<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0' width='" + width + "' height='" + height + "'><PARAM NAME=wmode VALUE=transparent><param name='movie' value='" + file + "'><param name='quality' value='high'><embed src='" + file + "' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='" + width + "' height='" + height + "'></embed></object>");
}

function embedObject(type, id, source, width, height) {
    this.type = type;
    this.id = id;
    this.source = source;
    this.width = width;
    this.height = height;
    this.objectParam = new String;
    this.embedparam = new String;

    if(this.id != '') {
        name = ' name="' + id + '"';
        id = ' id="' + id + '"';
    }

    switch (this.type) {
        case 'flash':
            this.objectParam = '<object' + id + ' CLASSID="CLSID:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="' + width + '" height="' + height + '">\n';
            this.objectParam += '<param name="movie" value="' + source + '">\n';
            this.embedParam = '<embed' + name + ' src="' + source + '" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" swLiveConnect="true" width="' + width + '" height="' + height + '" ';
            break;
        case 'media':
            this.objectParam = '<object' + id + ' CLASSID="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6" width="' + width + '" height="' + height + '" standby="Loading Microsoft Windows Media Player components...">\n';
            this.objectParam += '<param name="URL" value="' + source + '">\n';
            this.embedParam = '<embed' + name + ' src="' + source + '" type="application/x-mplayer2" width="' + width + '" height="' + height + '" ';
            break;
        default:
            this.objectParam = '<object' + id + '>\n';
            this.embedParam = '<embed' + name + ' ';
    }

    this.setParam = function(key, value) {
        this.objectParam += '<param name="' + key + '" value="' + value + '">\n';
        this.embedParam += ' ' + key + '="' + value + '" ';
    }

    this.show = function() {
        this.embedParam += '>\n';
        document.write(this.objectParam + this.embedParam + '</object>\n');
    }
}

function showFlash() {
    var params = showFlash.arguments;

    if(params[3]) {
        var id = params[3];
    } else {
        var id = '';
    }
    flashObject = new embedObject('flash', id, params[0], params[1], params[2]);
    flashObject.setParam('quality', 'high');
    flashObject.setParam('wmode', 'transparent');
    flashObject.setParam('allowScriptAccess', 'always');
    flashObject.show();
}

function showMedia(source, width, height) {
    mediaObject = new embedObject('media', 'MediaPlayer', source, width, height);
    mediaObject.setParam('stretchTofit', 'true');
    mediaObject.setParam('autostart', 'true');
    mediaObject.show();
}