function JPEGEncoder(k) {
    var m = this;
    var C = Math.round;
    var K = Math.floor;
    var g = new Array(64);
    var J = new Array(64);
    var Q = new Array(64);
    var X = new Array(64);
    var A;
    var h;
    var q;
    var T;
    var I = new Array(65535);
    var l = new Array(65535);
    var O = new Array(64);
    var R = new Array(64);
    var i = [];
    var B = 0;
    var a = 7;
    var D = new Array(64);
    var d = new Array(64);
    var U = new Array(64);
    var e = new Array(256);
    var E = new Array(2048);
    var z;
    var N = [0, 1, 5, 6, 14, 15, 27, 28, 2, 4, 7, 13, 16, 26, 29, 42, 3, 8, 12, 17, 25, 30, 41, 43, 9, 11, 18, 24, 31, 40, 44, 53, 10, 19, 23, 32, 39, 45, 52, 54, 20, 22, 33, 38, 46, 51, 55, 60, 21, 34, 37, 47, 50, 56, 59, 61, 35, 36, 48, 49, 57, 58, 62, 63];
    var f = [0, 0, 1, 5, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0];
    var b = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
    var y = [0, 0, 2, 1, 3, 3, 2, 4, 3, 5, 5, 4, 4, 0, 0, 1, 125];
    var s = [1, 2, 3, 0, 4, 17, 5, 18, 33, 49, 65, 6, 19, 81, 97, 7, 34, 113, 20, 50, 129, 145, 161, 8, 35, 66, 177, 193, 21, 82, 209, 240, 36, 51, 98, 114, 130, 9, 10, 22, 23, 24, 25, 26, 37, 38, 39, 40, 41, 42, 52, 53, 54, 55, 56, 57, 58, 67, 68, 69, 70, 71, 72, 73, 74, 83, 84, 85, 86, 87, 88, 89, 90, 99, 100, 101, 102, 103, 104, 105, 106, 115, 116, 117, 118, 119, 120, 121, 122, 131, 132, 133, 134, 135, 136, 137, 138, 146, 147, 148, 149, 150, 151, 152, 153, 154, 162, 163, 164, 165, 166, 167, 168, 169, 170, 178, 179, 180, 181, 182, 183, 184, 185, 186, 194, 195, 196, 197, 198, 199, 200, 201, 202, 210, 211, 212, 213, 214, 215, 216, 217, 218, 225, 226, 227, 228, 229, 230, 231, 232, 233, 234, 241, 242, 243, 244, 245, 246, 247, 248, 249, 250];
    var x = [0, 0, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0];
    var Y = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
    var n = [0, 0, 2, 1, 2, 4, 4, 3, 4, 7, 5, 4, 4, 0, 1, 2, 119];
    var u = [0, 1, 2, 3, 17, 4, 5, 33, 49, 6, 18, 65, 81, 7, 97, 113, 19, 34, 50, 129, 8, 20, 66, 145, 161, 177, 193, 9, 35, 51, 82, 240, 21, 98, 114, 209, 10, 22, 36, 52, 225, 37, 241, 23, 24, 25, 26, 38, 39, 40, 41, 42, 53, 54, 55, 56, 57, 58, 67, 68, 69, 70, 71, 72, 73, 74, 83, 84, 85, 86, 87, 88, 89, 90, 99, 100, 101, 102, 103, 104, 105, 106, 115, 116, 117, 118, 119, 120, 121, 122, 130, 131, 132, 133, 134, 135, 136, 137, 138, 146, 147, 148, 149, 150, 151, 152, 153, 154, 162, 163, 164, 165, 166, 167, 168, 169, 170, 178, 179, 180, 181, 182, 183, 184, 185, 186, 194, 195, 196, 197, 198, 199, 200, 201, 202, 210, 211, 212, 213, 214, 215, 216, 217, 218, 226, 227, 228, 229, 230, 231, 232, 233, 234, 242, 243, 244, 245, 246, 247, 248, 249, 250];

    function L(ag) {
        var af = [16, 11, 10, 16, 24, 40, 51, 61, 12, 12, 14, 19, 26, 58, 60, 55, 14, 13, 16, 24, 40, 57, 69, 56, 14, 17, 22, 29, 51, 87, 80, 62, 18, 22, 37, 56, 68, 109, 103, 77, 24, 35, 55, 64, 81, 104, 113, 92, 49, 64, 78, 87, 103, 121, 120, 101, 72, 92, 95, 98, 112, 100, 103, 99];
        for (var ae = 0; ae < 64; ae++) {
            var aj = K((af[ae] * ag + 50) / 100);
            if (aj < 1) {
                aj = 1
            } else {
                if (aj > 255) {
                    aj = 255
                }
            }
            g[N[ae]] = aj
        }
        var ah = [17, 18, 24, 47, 99, 99, 99, 99, 18, 21, 26, 66, 99, 99, 99, 99, 24, 26, 56, 99, 99, 99, 99, 99, 47, 66, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99];
        for (var ad = 0; ad < 64; ad++) {
            var ai = K((ah[ad] * ag + 50) / 100);
            if (ai < 1) {
                ai = 1
            } else {
                if (ai > 255) {
                    ai = 255
                }
            }
            J[N[ad]] = ai
        }
        var ac = [1, 1.387039845, 1.306562965, 1.175875602, 1, 0.785694958, 0.5411961, 0.275899379];
        var ab = 0;
        for (var ak = 0; ak < 8; ak++) {
            for (var aa = 0; aa < 8; aa++) {
                Q[ab] = (1 / (g[N[ab]] * ac[ak] * ac[aa] * 8));
                X[ab] = (1 / (J[N[ab]] * ac[ak] * ac[aa] * 8));
                ab++
            }
        }
    }

    function H(ae, af) {
        var ad = 0;
        var ag = 0;
        var ac = new Array();
        for (var aa = 1; aa <= 16; aa++) {
            for (var ab = 1; ab <= ae[aa]; ab++) {
                ac[af[ag]] = [];
                ac[af[ag]][0] = ad;
                ac[af[ag]][1] = aa;
                ag++;
                ad++
            }
            ad *= 2
        }
        return ac
    }

    function W() {
        A = H(f, b);
        h = H(x, Y);
        q = H(y, s);
        T = H(n, u)
    }

    function v() {
        var ab = 1;
        var ad = 2;
        for (var aa = 1; aa <= 15; aa++) {
            for (var ac = ab; ac < ad; ac++) {
                l[32767 + ac] = aa;
                I[32767 + ac] = [];
                I[32767 + ac][1] = aa;
                I[32767 + ac][0] = ac
            }
            for (var ae = -(ad - 1); ae <= -ab; ae++) {
                l[32767 + ae] = aa;
                I[32767 + ae] = [];
                I[32767 + ae][1] = aa;
                I[32767 + ae][0] = ad - 1 + ae
            }
            ab <<= 1;
            ad <<= 1
        }
    }

    function V() {
        for (var aa = 0; aa < 256; aa++) {
            E[aa] = 19595 * aa;
            E[(aa + 256) >> 0] = 38470 * aa;
            E[(aa + 512) >> 0] = 7471 * aa + 32768;
            E[(aa + 768) >> 0] = -11059 * aa;
            E[(aa + 1024) >> 0] = -21709 * aa;
            E[(aa + 1280) >> 0] = 32768 * aa + 8421375;
            E[(aa + 1536) >> 0] = -27439 * aa;
            E[(aa + 1792) >> 0] = -5329 * aa
        }
    }

    function Z(ab) {
        var ac = ab[0];
        var aa = ab[1] - 1;
        while (aa >= 0) {
            if (ac & (1 << aa)) {
                B |= (1 << a)
            }
            aa--;
            a--;
            if (a < 0) {
                if (B == 255) {
                    r(255);
                    r(0)
                } else {
                    r(B)
                }
                a = 7;
                B = 0
            }
        }
    }

    function r(aa) {
        i.push(e[aa])
    }

    function G(aa) {
        r((aa >> 8) & 255);
        r((aa) & 255)
    }

    function M(aY, av) {
        var aM, aL, aK, aJ, aI, aG, aF, aD;
        var aP = 0;
        var aR;
        const au = 8;
        const an = 64;
        for (aR = 0; aR < au; ++aR) {
            aM = aY[aP];
            aL = aY[aP + 1];
            aK = aY[aP + 2];
            aJ = aY[aP + 3];
            aI = aY[aP + 4];
            aG = aY[aP + 5];
            aF = aY[aP + 6];
            aD = aY[aP + 7];
            var aZ = aM + aD;
            var aO = aM - aD;
            var aX = aL + aF;
            var aQ = aL - aF;
            var aW = aK + aG;
            var aS = aK - aG;
            var aV = aJ + aI;
            var aT = aJ - aI;
            var ar = aZ + aV;
            var ao = aZ - aV;
            var aq = aX + aW;
            var ap = aX - aW;
            aY[aP] = ar + aq;
            aY[aP + 4] = ar - aq;
            var aA = (ap + ao) * 0.707106781;
            aY[aP + 2] = ao + aA;
            aY[aP + 6] = ao - aA;
            ar = aT + aS;
            aq = aS + aQ;
            ap = aQ + aO;
            var aw = (ar - ap) * 0.382683433;
            var az = 0.5411961 * ar + aw;
            var ax = 1.306562965 * ap + aw;
            var ay = aq * 0.707106781;
            var ak = aO + ay;
            var aj = aO - ay;
            aY[aP + 5] = aj + az;
            aY[aP + 3] = aj - az;
            aY[aP + 1] = ak + ax;
            aY[aP + 7] = ak - ax;
            aP += 8
        }
        aP = 0;
        for (aR = 0; aR < au; ++aR) {
            aM = aY[aP];
            aL = aY[aP + 8];
            aK = aY[aP + 16];
            aJ = aY[aP + 24];
            aI = aY[aP + 32];
            aG = aY[aP + 40];
            aF = aY[aP + 48];
            aD = aY[aP + 56];
            var am = aM + aD;
            var at = aM - aD;
            var ah = aL + aF;
            var aB = aL - aF;
            var ae = aK + aG;
            var aE = aK - aG;
            var ab = aJ + aI;
            var aU = aJ - aI;
            var al = am + ab;
            var aa = am - ab;
            var ag = ah + ae;
            var ad = ah - ae;
            aY[aP] = al + ag;
            aY[aP + 32] = al - ag;
            var ai = (ad + aa) * 0.707106781;
            aY[aP + 16] = aa + ai;
            aY[aP + 48] = aa - ai;
            al = aU + aE;
            ag = aE + aB;
            ad = aB + at;
            var aN = (al - ad) * 0.382683433;
            var af = 0.5411961 * al + aN;
            var a1 = 1.306562965 * ad + aN;
            var ac = ag * 0.707106781;
            var a0 = at + ac;
            var aC = at - ac;
            aY[aP + 40] = aC + af;
            aY[aP + 24] = aC - af;
            aY[aP + 8] = a0 + a1;
            aY[aP + 56] = a0 - a1;
            aP++
        }
        var aH;
        for (aR = 0; aR < an; ++aR) {
            aH = aY[aR] * av[aR];
            O[aR] = (aH > 0) ? ((aH + 0.5) | 0) : ((aH - 0.5) | 0)
        }
        return O
    }

    function S() {
        G(65504);
        G(16);
        r(74);
        r(70);
        r(73);
        r(70);
        r(0);
        r(1);
        r(1);
        r(0);
        G(1);
        G(1);
        r(0);
        r(0)
    }

    function F(ab, aa) {
        G(65472);
        G(17);
        r(8);
        G(aa);
        G(ab);
        r(3);
        r(1);
        r(17);
        r(0);
        r(2);
        r(17);
        r(1);
        r(3);
        r(17);
        r(1)
    }

    function t() {
        G(65499);
        G(132);
        r(0);
        for (var ab = 0; ab < 64; ab++) {
            r(g[ab])
        }
        r(1);
        for (var aa = 0; aa < 64; aa++) {
            r(J[aa])
        }
    }

    function p() {
        G(65476);
        G(418);
        r(0);
        for (var ae = 0; ae < 16; ae++) {
            r(f[ae + 1])
        }
        for (var ad = 0; ad <= 11; ad++) {
            r(b[ad])
        }
        r(16);
        for (var ac = 0; ac < 16; ac++) {
            r(y[ac + 1])
        }
        for (var ab = 0; ab <= 161; ab++) {
            r(s[ab])
        }
        r(1);
        for (var aa = 0; aa < 16; aa++) {
            r(x[aa + 1])
        }
        for (var ah = 0; ah <= 11; ah++) {
            r(Y[ah])
        }
        r(17);
        for (var ag = 0; ag < 16; ag++) {
            r(n[ag + 1])
        }
        for (var af = 0; af <= 161; af++) {
            r(u[af])
        }
    }

    function o() {
        G(65498);
        G(12);
        r(3);
        r(1);
        r(0);
        r(2);
        r(17);
        r(3);
        r(17);
        r(0);
        r(63);
        r(0)
    }

    function j(ae, aa, ak, ap, ao) {
        var ag = ao[0];
        var ac = ao[240];
        var ad;
        const aq = 16;
        const ah = 63;
        const af = 64;
        var ar = M(ae, aa);
        for (var al = 0; al < af; ++al) {
            R[N[al]] = ar[al]
        }
        var an = R[0] - ak;
        ak = R[0];
        if (an == 0) {
            Z(ap[0])
        } else {
            ad = 32767 + an;
            Z(ap[l[ad]]);
            Z(I[ad])
        }
        var ab = 63;
        for (; (ab > 0) && (R[ab] == 0); ab--) {
        }
        if (ab == 0) {
            Z(ag);
            return ak
        }
        var am = 1;
        var au;
        while (am <= ab) {
            var aj = am;
            for (; (R[am] == 0) && (am <= ab); ++am) {
            }
            var ai = am - aj;
            if (ai >= aq) {
                au = ai >> 4;
                for (var at = 1; at <= au; ++at) {
                    Z(ac)
                }
                ai = ai & 15
            }
            ad = 32767 + R[am];
            Z(ao[(ai << 4) + l[ad]]);
            Z(I[ad]);
            am++
        }
        if (ab != ah) {
            Z(ag)
        }
        return ak
    }

    function w() {
        var ab = String.fromCharCode;
        for (var aa = 0; aa < 256; aa++) {
            e[aa] = ab(aa)
        }
    }

    this.encode = function (ap, ak) {
        var ac = new Date().getTime();
        if (ak) {
            c(ak)
        }
        i = new Array();
        B = 0;
        a = 7;
        G(65496);
        S();
        t();
        F(ap.width, ap.height);
        p();
        o();
        var al = 0;
        var ar = 0;
        var ao = 0;
        B = 0;
        a = 7;
        this.encode.displayName = "_encode_";
        var ax = ap.data;
        var au = ap.width;
        var an = ap.height;
        var at = au * 4;
        var ab = au * 3;
        var aj, ai = 0;
        var am, aw, ay;
        var ad, aq, af, ah, ag;
        while (ai < an) {
            aj = 0;
            while (aj < at) {
                ad = at * ai + aj;
                aq = ad;
                af = -1;
                ah = 0;
                for (ag = 0; ag < 64; ag++) {
                    ah = ag >> 3;
                    af = (ag & 7) * 4;
                    aq = ad + (ah * at) + af;
                    if (ai + ah >= an) {
                        aq -= (at * (ai + 1 + ah - an))
                    }
                    if (aj + af >= at) {
                        aq -= ((aj + af) - at + 4)
                    }
                    am = ax[aq++];
                    aw = ax[aq++];
                    ay = ax[aq++];
                    D[ag] = ((E[am] + E[(aw + 256) >> 0] + E[(ay + 512) >> 0]) >> 16) - 128;
                    d[ag] = ((E[(am + 768) >> 0] + E[(aw + 1024) >> 0] + E[(ay + 1280) >> 0]) >> 16) - 128;
                    U[ag] = ((E[(am + 1280) >> 0] + E[(aw + 1536) >> 0] + E[(ay + 1792) >> 0]) >> 16) - 128
                }
                al = j(D, Q, al, A, q);
                ar = j(d, X, ar, h, T);
                ao = j(U, X, ao, h, T);
                aj += 32
            }
            ai += 8
        }
        if (a >= 0) {
            var av = [];
            av[1] = a + 1;
            av[0] = (1 << (a + 1)) - 1;
            Z(av)
        }
        G(65497);
        var ae = "data:image/jpeg;base64," + btoa(i.join(""));
        i = [];
        var aa = new Date().getTime() - ac;
        console.log("Encoding time: " + aa + "ms");
        return ae
    };
    function c(ab) {
        if (ab <= 0) {
            ab = 1
        }
        if (ab > 100) {
            ab = 100
        }
        if (z == ab) {
            return
        }
        var aa = 0;
        if (ab < 50) {
            aa = Math.floor(5000 / ab)
        } else {
            aa = Math.floor(200 - ab * 2)
        }
        L(aa);
        z = ab;
        console.log("Quality set to: " + ab + "%")
    }

    function P() {
        var ab = new Date().getTime();
        if (!k) {
            k = 50
        }
        w();
        W();
        v();
        V();
        c(k);
        var aa = new Date().getTime() - ab;
        console.log("Initialization " + aa + "ms")
    }

    P()
}
function getImageDataFromImage(b) {
    var c = (typeof(b) == "string") ? document.getElementById(b) : b;
    var d = document.createElement("canvas");
    d.width = c.width;
    d.height = c.height;
    var a = d.getContext("2d");
    a.drawImage(c, 0, 0);
    return(a.getImageData(0, 0, d.width, d.height))
};