var JpegMeta = {};
this.JpegMeta = JpegMeta;
JpegMeta.parseNum = function parseNum(a, g, h, d) {
    var c;
    var b;
    var e = (a === ">");
    if (h === undefined) {
        h = 0
    }
    if (d === undefined) {
        d = g.length - h
    }
    for (e ? c = h : c = h + d - 1; e ? c < h + d : c >= h; e ? c++ : c--) {
        b <<= 8;
        b += g.charCodeAt(c)
    }
    return b
};
JpegMeta.parseSnum = function parseSnum(a, g, h, d) {
    var c;
    var b;
    var j;
    var e = (a === ">");
    if (h === undefined) {
        h = 0
    }
    if (d === undefined) {
        d = g.length - h
    }
    for (e ? c = h : c = h + d - 1; e ? c < h + d : c >= h; e ? c++ : c--) {
        if (j === undefined) {
            j = (g.charCodeAt(c) & 128) === 128
        }
        b <<= 8;
        b += j ? ~g.charCodeAt(c) & 255 : g.charCodeAt(c)
    }
    if (j) {
        b += 1;
        b *= -1
    }
    return b
};
JpegMeta.Rational = function Rational(a, b) {
    this.num = a;
    this.den = b || 1;
    return this
};
JpegMeta.Rational.prototype.toString = function toString() {
    if (this.num === 0) {
        return"" + this.num
    }
    if (this.den === 1) {
        return"" + this.num
    }
    if (this.num === 1) {
        return this.num + " / " + this.den
    }
    return this.num / this.den
};
JpegMeta.Rational.prototype.asFloat = function asFloat() {
    return this.num / this.den
};
JpegMeta.MetaGroup = function MetaGroup(b, a) {
    this.fieldName = b;
    this.description = a;
    this.metaProps = {};
    return this
};
JpegMeta.MetaGroup.prototype._addProperty = function _addProperty(d, a, c) {
    var b = new JpegMeta.MetaProp(d, a, c);
    this[b.fieldName] = b;
    this.metaProps[b.fieldName] = b
};
JpegMeta.MetaGroup.prototype.toString = function toString() {
    return"[MetaGroup " + this.description + "]"
};
JpegMeta.MetaProp = function MetaProp(c, a, b) {
    this.fieldName = c;
    this.description = a;
    this.value = b;
    return this
};
JpegMeta.MetaProp.prototype.toString = function toString() {
    return"" + this.value
};
JpegMeta.JpegFile = function JpegFile(m, a) {
    var k = this._SOS;
    this.metaGroups = {};
    this._binary_data = m;
    this.filename = a;
    var l = 0;
    var g = 0;
    var c;
    var i;
    var b;
    var h;
    var d;
    var e;
    var j;
    if (this._binary_data.slice(0, 2) !== this._SOI_MARKER) {
        throw new Error("Doesn't look like a JPEG file. First two bytes are " + this._binary_data.charCodeAt(0) + "," + this._binary_data.charCodeAt(1) + ".")
    }
    l += 2;
    while (l < this._binary_data.length) {
        c = this._binary_data.charCodeAt(l++);
        i = this._binary_data.charCodeAt(l++);
        console.log(i.toString(16));
        g = l;
        if (c != this._DELIM) {
            break
        }
        if (i === k) {
            break
        }
        d = JpegMeta.parseNum(">", this._binary_data, l, 2);
        console.log("headsize=" + d);
        l += d;
        while (l < this._binary_data.length) {
            c = this._binary_data.charCodeAt(l++);
            if (c == this._DELIM) {
                b = this._binary_data.charCodeAt(l++);
                if (b != 0) {
                    l -= 2;
                    break
                }
            }
        }
        h = l - g;
        if (this._markers[i]) {
            e = this._markers[i][0];
            j = this._markers[i][1]
        } else {
            e = "UNKN";
            j = undefined
        }
        if (j) {
            this[j](i, g + 2)
        }
    }
    if (this.general === undefined) {
        throw Error("Invalid JPEG file.")
    }
    return this
};
this.JpegMeta.JpegFile.prototype.toString = function () {
    return"[JpegFile " + this.filename + " " + this.general.type + " " + this.general.pixelWidth + "x" + this.general.pixelHeight + " Depth: " + this.general.depth + "]"
};
this.JpegMeta.JpegFile.prototype._SOI_MARKER = "\xff\xd8";
this.JpegMeta.JpegFile.prototype._DELIM = 255;
this.JpegMeta.JpegFile.prototype._EOI = 217;
this.JpegMeta.JpegFile.prototype._SOS = 218;
this.JpegMeta.JpegFile.prototype._sofHandler = function _sofHandler(b, a) {
    if (this.general !== undefined) {
        throw Error("Unexpected multiple-frame image")
    }
    this._addMetaGroup("general", "General");
    this.general._addProperty("depth", "Depth", JpegMeta.parseNum(">", this._binary_data, a, 1));
    this.general._addProperty("pixelHeight", "Pixel Height", JpegMeta.parseNum(">", this._binary_data, a + 1, 2));
    this.general._addProperty("pixelWidth", "Pixel Width", JpegMeta.parseNum(">", this._binary_data, a + 3, 2));
    this.general._addProperty("type", "Type", this._markers[b][2])
};
this.JpegMeta.JpegFile.prototype._JFIF_IDENT = "JFIF\x00";
this.JpegMeta.JpegFile.prototype._JFXX_IDENT = "JFXX\x00";
this.JpegMeta.JpegFile.prototype._EXIF_IDENT = "Exif\x00";
this.JpegMeta.JpegFile.prototype._types = {1: ["BYTE", 1], 2: ["ASCII", 1], 3: ["SHORT", 2], 4: ["LONG", 4], 5: ["RATIONAL", 8], 6: ["SBYTE", 1], 7: ["UNDEFINED", 1], 8: ["SSHORT", 2], 9: ["SLONG", 4], 10: ["SRATIONAL", 8], 11: ["FLOAT", 4], 12: ["DOUBLE", 8]};
this.JpegMeta.JpegFile.prototype._tifftags = {256: ["Image width", "ImageWidth"], 257: ["Image height", "ImageLength"], 258: ["Number of bits per component", "BitsPerSample"], 259: ["Compression scheme", "Compression", {1: "uncompressed", 6: "JPEG compression"}], 262: ["Pixel composition", "PhotmetricInerpretation", {2: "RGB", 6: "YCbCr"}], 274: ["Orientation of image", "Orientation", {1: "Normal", 2: "Reverse?", 3: "Upside-down", 4: "Upside-down Reverse", 5: "90 degree CW", 6: "90 degree CW reverse", 7: "90 degree CCW", 8: "90 degree CCW reverse"}], 277: ["Number of components", "SamplesPerPixel"], 284: ["Image data arrangement", "PlanarConfiguration", {1: "chunky format", 2: "planar format"}], 530: ["Subsampling ratio of Y to C", "YCbCrSubSampling"], 531: ["Y and C positioning", "YCbCrPositioning", {1: "centered", 2: "co-sited"}], 282: ["X Resolution", "XResolution"], 283: ["Y Resolution", "YResolution"], 296: ["Resolution Unit", "ResolutionUnit", {2: "inches", 3: "centimeters"}], 273: ["Image data location", "StripOffsets"], 278: ["Number of rows per strip", "RowsPerStrip"], 279: ["Bytes per compressed strip", "StripByteCounts"], 513: ["Offset to JPEG SOI", "JPEGInterchangeFormat"], 514: ["Bytes of JPEG Data", "JPEGInterchangeFormatLength"], 301: ["Transfer function", "TransferFunction"], 318: ["White point chromaticity", "WhitePoint"], 319: ["Chromaticities of primaries", "PrimaryChromaticities"], 529: ["Color space transformation matrix coefficients", "YCbCrCoefficients"], 532: ["Pair of black and white reference values", "ReferenceBlackWhite"], 306: ["Date and time", "DateTime"], 270: ["Image title", "ImageDescription"], 271: ["Make", "Make"], 272: ["Model", "Model"], 305: ["Software", "Software"], 315: ["Person who created the image", "Artist"], 316: ["Host Computer", "HostComputer"], 33432: ["Copyright holder", "Copyright"], 34665: ["Exif tag", "ExifIfdPointer"], 34853: ["GPS tag", "GPSInfoIfdPointer"]};
this.JpegMeta.JpegFile.prototype._exiftags = {36864: ["Exif Version", "ExifVersion"], 40960: ["FlashPix Version", "FlashpixVersion"], 40961: ["Color Space", "ColorSpace"], 37121: ["Meaning of each component", "ComponentsConfiguration"], 37122: ["Compressed Bits Per Pixel", "CompressedBitsPerPixel"], 40962: ["Pixel X Dimension", "PixelXDimension"], 40963: ["Pixel Y Dimension", "PixelYDimension"], 37500: ["Manufacturer notes", "MakerNote"], 37510: ["User comments", "UserComment"], 40964: ["Related audio file", "RelatedSoundFile"], 36867: ["Date Time Original", "DateTimeOriginal"], 36868: ["Date Time Digitized", "DateTimeDigitized"], 37520: ["DateTime subseconds", "SubSecTime"], 37521: ["DateTimeOriginal subseconds", "SubSecTimeOriginal"], 37522: ["DateTimeDigitized subseconds", "SubSecTimeDigitized"], 33434: ["Exposure time", "ExposureTime"], 33437: ["FNumber", "FNumber"], 34850: ["Exposure program", "ExposureProgram"], 34852: ["Spectral sensitivity", "SpectralSensitivity"], 34855: ["ISO Speed Ratings", "ISOSpeedRatings"], 34856: ["Optoelectric coefficient", "OECF"], 37377: ["Shutter Speed", "ShutterSpeedValue"], 37378: ["Aperture Value", "ApertureValue"], 37379: ["Brightness", "BrightnessValue"], 37380: ["Exposure Bias Value", "ExposureBiasValue"], 37381: ["Max Aperture Value", "MaxApertureValue"], 37382: ["Subject Distance", "SubjectDistance"], 37383: ["Metering Mode", "MeteringMode"], 37384: ["Light Source", "LightSource"], 37385: ["Flash", "Flash"], 37386: ["Focal Length", "FocalLength"], 37396: ["Subject Area", "SubjectArea"], 41483: ["Flash Energy", "FlashEnergy"], 41484: ["Spatial Frequency Response", "SpatialFrequencyResponse"], 41486: ["Focal Plane X Resolution", "FocalPlaneXResolution"], 41487: ["Focal Plane Y Resolution", "FocalPlaneYResolution"], 41488: ["Focal Plane Resolution Unit", "FocalPlaneResolutionUnit"], 41492: ["Subject Location", "SubjectLocation"], 41493: ["Exposure Index", "ExposureIndex"], 41495: ["Sensing Method", "SensingMethod"], 41728: ["File Source", "FileSource"], 41729: ["Scene Type", "SceneType"], 41730: ["CFA Pattern", "CFAPattern"], 41985: ["Custom Rendered", "CustomRendered"], 41986: ["Exposure Mode", "Exposure Mode"], 41987: ["White Balance", "WhiteBalance"], 41988: ["Digital Zoom Ratio", "DigitalZoomRatio"], 41990: ["Scene Capture Type", "SceneCaptureType"], 41991: ["Gain Control", "GainControl"], 41992: ["Contrast", "Contrast"], 41993: ["Saturation", "Saturation"], 41994: ["Sharpness", "Sharpness"], 41995: ["Device settings description", "DeviceSettingDescription"], 41996: ["Subject distance range", "SubjectDistanceRange"], 42016: ["Unique image ID", "ImageUniqueID"], 40965: ["Interoperability tag", "InteroperabilityIFDPointer"]};
this.JpegMeta.JpegFile.prototype._gpstags = {0: ["GPS tag version", "GPSVersionID"], 1: ["North or South Latitude", "GPSLatitudeRef"], 2: ["Latitude", "GPSLatitude"], 3: ["East or West Longitude", "GPSLongitudeRef"], 4: ["Longitude", "GPSLongitude"], 5: ["Altitude reference", "GPSAltitudeRef"], 6: ["Altitude", "GPSAltitude"], 7: ["GPS time (atomic clock)", "GPSTimeStamp"], 8: ["GPS satellites usedd for measurement", "GPSSatellites"], 9: ["GPS receiver status", "GPSStatus"], 10: ["GPS mesaurement mode", "GPSMeasureMode"], 11: ["Measurement precision", "GPSDOP"], 12: ["Speed unit", "GPSSpeedRef"], 13: ["Speed of GPS receiver", "GPSSpeed"], 14: ["Reference for direction of movement", "GPSTrackRef"], 15: ["Direction of movement", "GPSTrack"], 16: ["Reference for direction of image", "GPSImgDirectionRef"], 17: ["Direction of image", "GPSImgDirection"], 18: ["Geodetic survey data used", "GPSMapDatum"], 19: ["Reference for latitude of destination", "GPSDestLatitudeRef"], 20: ["Latitude of destination", "GPSDestLatitude"], 21: ["Reference for longitude of destination", "GPSDestLongitudeRef"], 22: ["Longitude of destination", "GPSDestLongitude"], 23: ["Reference for bearing of destination", "GPSDestBearingRef"], 24: ["Bearing of destination", "GPSDestBearing"], 25: ["Reference for distance to destination", "GPSDestDistanceRef"], 26: ["Distance to destination", "GPSDestDistance"], 27: ["Name of GPS processing method", "GPSProcessingMethod"], 28: ["Name of GPS area", "GPSAreaInformation"], 29: ["GPS Date", "GPSDateStamp"], 30: ["GPS differential correction", "GPSDifferential"]};
this.JpegMeta.JpegFile.prototype._markers = {192: ["SOF0", "_sofHandler", "Baseline DCT"], 193: ["SOF1", "_sofHandler", "Extended sequential DCT"], 194: ["SOF2", "_sofHandler", "Progressive DCT"], 195: ["SOF3", "_sofHandler", "Lossless (sequential)"], 197: ["SOF5", "_sofHandler", "Differential sequential DCT"], 198: ["SOF6", "_sofHandler", "Differential progressive DCT"], 199: ["SOF7", "_sofHandler", "Differential lossless (sequential)"], 200: ["JPG", null, "Reserved for JPEG extensions"], 201: ["SOF9", "_sofHandler", "Extended sequential DCT"], 202: ["SOF10", "_sofHandler", "Progressive DCT"], 203: ["SOF11", "_sofHandler", "Lossless (sequential)"], 205: ["SOF13", "_sofHandler", "Differential sequential DCT"], 206: ["SOF14", "_sofHandler", "Differential progressive DCT"], 207: ["SOF15", "_sofHandler", "Differential lossless (sequential)"], 196: ["DHT", null, "Define Huffman table(s)"], 204: ["DAC", null, "Define arithmetic coding conditioning(s)"], 208: ["RST0", null, "Restart with modulo 8 count “0”"], 209: ["RST1", null, "Restart with modulo 8 count “1”"], 210: ["RST2", null, "Restart with modulo 8 count “2”"], 211: ["RST3", null, "Restart with modulo 8 count “3”"], 212: ["RST4", null, "Restart with modulo 8 count “4”"], 213: ["RST5", null, "Restart with modulo 8 count “5”"], 214: ["RST6", null, "Restart with modulo 8 count “6”"], 215: ["RST7", null, "Restart with modulo 8 count “7”"], 216: ["SOI", null, "Start of image"], 217: ["EOI", null, "End of image"], 218: ["SOS", null, "Start of scan"], 219: ["DQT", null, "Define quantization table(s)"], 220: ["DNL", null, "Define number of lines"], 221: ["DRI", null, "Define restart interval"], 222: ["DHP", null, "Define hierarchical progression"], 223: ["EXP", null, "Expand reference component(s)"], 224: ["APP0", "_app0Handler", "Reserved for application segments"], 225: ["APP1", "_app1Handler"], 226: ["APP2", null], 227: ["APP3", null], 228: ["APP4", null], 229: ["APP5", null], 230: ["APP6", null], 231: ["APP7", null], 232: ["APP8", null], 233: ["APP9", null], 234: ["APP10", null], 235: ["APP11", null], 236: ["APP12", null], 237: ["APP13", null], 238: ["APP14", null], 239: ["APP15", null], 240: ["JPG0", null], 241: ["JPG1", null], 242: ["JPG2", null], 243: ["JPG3", null], 244: ["JPG4", null], 245: ["JPG5", null], 246: ["JPG6", null], 247: ["JPG7", null], 248: ["JPG8", null], 249: ["JPG9", null], 250: ["JPG10", null], 251: ["JPG11", null], 252: ["JPG12", null], 253: ["JPG13", null], 254: ["COM", null], 1: ["JPG13", null]};
this.JpegMeta.JpegFile.prototype._addMetaGroup = function _addMetaGroup(a, b) {
    var c = new JpegMeta.MetaGroup(a, b);
    this[c.fieldName] = c;
    this.metaGroups[c.fieldName] = c;
    return c
};
this.JpegMeta.JpegFile.prototype._parseIfd = function _parseIfd(x, s, g, q, p, y, u) {
    var t = JpegMeta.parseNum(x, s, g + q, 2);
    var w, v;
    var b;
    var h;
    var c, e, o;
    var d;
    var n;
    var r;
    var a;
    var l;
    var k;
    var m;
    m = this._addMetaGroup(y, u);
    for (var w = 0; w < t; w++) {
        b = g + q + 2 + (w * 12);
        h = JpegMeta.parseNum(x, s, b, 2);
        console.log("tag-field=" + h);
        e = JpegMeta.parseNum(x, s, b + 2, 2);
        d = JpegMeta.parseNum(x, s, b + 4, 4);
        n = JpegMeta.parseNum(x, s, b + 8, 4);
        if (this._types[e] === undefined) {
            continue
        }
        c = this._types[e][0];
        o = this._types[e][1];
        if (o * d <= 4) {
            n = b + 8
        } else {
            n = g + n
        }
        if (c == "UNDEFINED") {
            f = s.slice(n, n + d)
        } else {
            if (c == "ASCII") {
                r = s.slice(n, n + d);
                r = r.split("\x00")[0]
            } else {
                r = new Array();
                for (v = 0; v < d; v++, n += o) {
                    if (c == "BYTE" || c == "SHORT" || c == "LONG") {
                        r.push(JpegMeta.parseNum(x, s, n, o))
                    }
                    if (c == "SBYTE" || c == "SSHORT" || c == "SLONG") {
                        r.push(JpegMeta.parseSnum(x, s, n, o))
                    }
                    if (c == "RATIONAL") {
                        l = JpegMeta.parseNum(x, s, n, 4);
                        k = JpegMeta.parseNum(x, s, n + 4, 4);
                        r.push(new JpegMeta.Rational(l, k))
                    }
                    if (c == "SRATIONAL") {
                        l = JpegMeta.parseSnum(x, s, n, 4);
                        k = JpegMeta.parseSnum(x, s, n + 4, 4);
                        r.push(new JpegMeta.Rational(l, k))
                    }
                    r.push()
                }
                if (d === 1) {
                    r = r[0]
                }
            }
        }
        if (p[h] !== undefined) {
            m._addProperty(p[h][1], p[h][0], r)
        }
    }
};
this.JpegMeta.JpegFile.prototype._jfifHandler = function _jfifHandler(b, a) {
    if (this.jfif !== undefined) {
        throw Error("Multiple JFIF segments found")
    }
    this._addMetaGroup("jfif", "JFIF");
    this.jfif._addProperty("version_major", "Version Major", this._binary_data.charCodeAt(a + 5));
    this.jfif._addProperty("version_minor", "Version Minor", this._binary_data.charCodeAt(a + 6));
    this.jfif._addProperty("version", "JFIF Version", this.jfif.version_major.value + "." + this.jfif.version_minor.value);
    this.jfif._addProperty("units", "Density Unit", this._binary_data.charCodeAt(a + 7));
    this.jfif._addProperty("Xdensity", "X density", JpegMeta.parseNum(">", this._binary_data, a + 8, 2));
    this.jfif._addProperty("Ydensity", "Y Density", JpegMeta.parseNum(">", this._binary_data, a + 10, 2));
    this.jfif._addProperty("Xthumbnail", "X Thumbnail", JpegMeta.parseNum(">", this._binary_data, a + 12, 1));
    this.jfif._addProperty("Ythumbnail", "Y Thumbnail", JpegMeta.parseNum(">", this._binary_data, a + 13, 1))
};
this.JpegMeta.JpegFile.prototype._app0Handler = function app0Handler(c, b) {
    var a = this._binary_data.slice(b, b + 5);
    if (a == this._JFIF_IDENT) {
        this._jfifHandler(c, b)
    } else {
        if (a == this._JFXX_IDENT) {
        } else {
        }
    }
};
this.JpegMeta.JpegFile.prototype._app1Handler = function _app1Handler(c, b) {
    var a = this._binary_data.slice(b, b + 5);
    if (a == this._EXIF_IDENT) {
        this._exifHandler(c, b + 6)
    } else {
    }
};
JpegMeta.JpegFile.prototype._exifHandler = function _exifHandler(d, l) {
    if (this.exif !== undefined) {
        throw new Error("Multiple JFIF segments found")
    }
    var h;
    var g;
    var c;
    var i, j, e;
    var b = this._binary_data.slice(l, l + 2);
    if (b === "II") {
        h = "<"
    } else {
        if (b === "MM") {
            h = ">"
        } else {
            throw new Error("Malformed TIFF meta-data. Unknown endianess: " + b)
        }
    }
    g = JpegMeta.parseNum(h, this._binary_data, l + 2, 2);
    if (g !== 42) {
        throw new Error("Malformed TIFF meta-data. Bad magic: " + g)
    }
    c = JpegMeta.parseNum(h, this._binary_data, l + 4, 4);
    this._parseIfd(h, this._binary_data, l, c, this._tifftags, "tiff", "TIFF");
    console.log(".,.,.,.,." + this.tiff.ExifIfdPointer.value);
    if (this.tiff.ExifIfdPointer) {
        console.log("has pointer1");
        this._parseIfd(h, this._binary_data, l, this.tiff.ExifIfdPointer.value, this._exiftags, "exif", "Exif")
    }
    if (this.tiff.GPSInfoIfdPointer) {
        this._parseIfd(h, this._binary_data, l, this.tiff.GPSInfoIfdPointer.value, this._gpstags, "gps", "GPS");
        if (this.gps.GPSLatitude) {
            var k;
            k = this.gps.GPSLatitude.value[0].asFloat() + (1 / 60) * this.gps.GPSLatitude.value[1].asFloat() + (1 / 3600) * this.gps.GPSLatitude.value[2].asFloat();
            if (this.gps.GPSLatitudeRef.value === "S") {
                k = -k
            }
            this.gps._addProperty("latitude", "Dec. Latitude", k)
        }
        if (this.gps.GPSLongitude) {
            var a;
            a = this.gps.GPSLongitude.value[0].asFloat() + (1 / 60) * this.gps.GPSLongitude.value[1].asFloat() + (1 / 3600) * this.gps.GPSLongitude.value[2].asFloat();
            if (this.gps.GPSLongitudeRef.value === "W") {
                a = -a
            }
            this.gps._addProperty("longitude", "Dec. Longitude", a)
        }
    }
};