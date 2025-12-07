var Pe = Object.defineProperty;
var Re = (t, r, o) => (r in t ? Pe(t, r, { enumerable: !0, configurable: !0, writable: !0, value: o }) : (t[r] = o));
var P = (t, r, o) => Re(t, typeof r != "symbol" ? r + "" : r, o);
const b = document.getElementById("sidebar");
let C = document.querySelector(".main-content");
const Me = document.querySelectorAll(".nav > ul > .slide.has-sub"),
    Ce = document.querySelectorAll(".nav > ul > .slide.has-sub > a"),
    Ge = document.querySelectorAll(".nav > ul > .slide.has-sub .slide.has-sub > a");
class We {
    constructor(r, o) {
        P(this, "instance", null);
        P(this, "reference", null);
        P(this, "popperTarget", null);
        this.init(r, o);
    }
    init(r, o) {
        (this.reference = r),
            (this.popperTarget = o),
            (this.instance = Popper.createPopper(this.reference, this.popperTarget, {
                placement: "bottom",
                strategy: "relative",
                resize: !0,
                modifiers: [{ name: "computeStyles", options: { adaptive: !1 } }],
            })),
            document.addEventListener("click", (i) => this.clicker(i, this.popperTarget, this.reference), !1);
        const l = new ResizeObserver(() => {
            this.instance.update();
        });
        l.observe(this.popperTarget), l.observe(this.reference);
    }
    clicker(r, o, l) {
        b.classList.contains("collapsed") && !o.contains(r.target) && !l.contains(r.target) && this.hide();
    }
    hide() {}
}
class He {
    constructor() {
        P(this, "subMenuPoppers", []);
        this.init();
    }
    init() {
        Me.forEach((r) => {
            this.subMenuPoppers.push(new We(r, r.lastElementChild)), this.closePoppers();
        });
    }
    togglePopper(r) {
        window.getComputedStyle(r).visibility === "hidden" && window.getComputedStyle(r).visibility === void 0
            ? (r.style.visibility = "visible")
            : (r.style.visibility = "hidden");
    }
    updatePoppers() {
        this.subMenuPoppers.forEach((r) => {
            (r.instance.state.elements.popper.style.display = "none"), r.instance.update();
        });
    }
    closePoppers() {
        this.subMenuPoppers.forEach((r) => {
            r.hide();
        });
    }
}
const H = (t, r = 300) => {
        const { parentElement: o } = t;
        o.classList.remove("open"),
            (t.style.transitionProperty = "height, margin, padding"),
            (t.style.transitionDuration = `${r}ms`),
            (t.style.boxSizing = "border-box"),
            (t.style.height = `${t.offsetHeight}px`),
            t.offsetHeight,
            (t.style.overflow = "hidden"),
            (t.style.height = 0),
            (t.style.paddingTop = 0),
            (t.style.paddingBottom = 0),
            (t.style.marginTop = 0),
            (t.style.marginBottom = 0),
            window.setTimeout(() => {
                (t.style.display = "none"),
                    t.style.removeProperty("height"),
                    t.style.removeProperty("padding-top"),
                    t.style.removeProperty("padding-bottom"),
                    t.style.removeProperty("margin-top"),
                    t.style.removeProperty("margin-bottom"),
                    t.style.removeProperty("overflow"),
                    t.style.removeProperty("transition-duration"),
                    t.style.removeProperty("transition-property");
            }, r);
        const l = t.closest("li");
        if (l) {
            const i = l.querySelector("ul");
            i && i.classList.remove("force-left");
        }
    },
    Ae = (t, r = 300) => {
        const { parentElement: o } = t;
        o.classList.add("open"), t.style.removeProperty("display");
        let { display: l } = window.getComputedStyle(t);
        l === "none" && (l = "block"), (t.style.display = l);
        const i = t.offsetHeight;
        (t.style.overflow = "hidden"),
            (t.style.height = 0),
            (t.style.paddingTop = 0),
            (t.style.paddingBottom = 0),
            (t.style.marginTop = 0),
            (t.style.marginBottom = 0),
            t.offsetHeight,
            (t.style.boxSizing = "border-box"),
            (t.style.transitionProperty = "height, margin, padding"),
            (t.style.transitionDuration = `${r}ms`),
            (t.style.height = `${i}px`),
            t.style.removeProperty("padding-top"),
            t.style.removeProperty("padding-bottom"),
            t.style.removeProperty("margin-top"),
            t.style.removeProperty("margin-bottom"),
            window.setTimeout(() => {
                t.style.removeProperty("height"),
                    t.style.removeProperty("overflow"),
                    t.style.removeProperty("transition-property"),
                    t.style.removeProperty("transition-duration");
            }, r);
        let n = document.documentElement;
        const s = t.closest("li");
        var m = s.getBoundingClientRect(),
            h = t.getBoundingClientRect().width,
            y = m.right + h,
            v = m.left - h;
        n.getAttribute("dir") == "rtl"
            ? v < 0 || (s.closest("ul").classList.contains("force-left") && y < window.innerWidth)
                ? t.classList.add("force-left")
                : t.classList.remove("force-left")
            : y > window.innerWidth || (s.closest("ul").classList.contains("force-left") && v > 0)
              ? t.classList.add("force-left")
              : (v < 0, t.classList.remove("force-left"));
    },
    xe = (t, r = 300) => {
        let o = document.querySelector("html");
        if (
            !(
                (o.getAttribute("data-nav-style") === "menu-hover" &&
                    o.getAttribute("data-toggled") === "menu-hover-closed" &&
                    window.innerWidth >= 992) ||
                (o.getAttribute("data-nav-style") === "icon-hover" &&
                    o.getAttribute("data-toggled") === "icon-hover-closed" &&
                    window.innerWidth >= 992)
            ) &&
            t &&
            t.nodeType != 3
        )
            return window.getComputedStyle(t).display === "none" ? Ae(t, r) : H(t, r);
    };
new He();
const Te = document.querySelectorAll(".slide.has-sub.open");
Te.forEach((t) => {
    t.lastElementChild.style.display = "block";
});
Ce.forEach((t) => {
    t.addEventListener("click", () => {
        let r = document.querySelector("html");
        if (
            (r.getAttribute("data-nav-style") != "menu-hover" && r.getAttribute("data-nav-style") != "icon-hover") ||
            window.innerWidth < 992 ||
            (!r.getAttribute("data-toggled") && r.getAttribute("data-nav-layout") != "horizontal")
        ) {
            const o = t.closest(".nav.sub-open");
            o &&
                o.querySelectorAll(":scope > ul > .slide.has-sub > a").forEach((l) => {
                    (l.nextElementSibling.style.display === "block" ||
                        window.getComputedStyle(l.nextElementSibling).display === "block") &&
                        H(l.nextElementSibling);
                }),
                xe(t.nextElementSibling);
        }
    });
});
Ge.forEach((t) => {
    let r = document.querySelector("html");
    t.addEventListener("click", () => {
        if (
            (r.getAttribute("data-nav-style") != "menu-hover" && r.getAttribute("data-nav-style") != "icon-hover") ||
            window.innerWidth < 992 ||
            (!r.getAttribute("data-toggled") && r.getAttribute("data-nav-layout") != "horizontal")
        ) {
            const o = t.closest(".slide-menu");
            o &&
                o.querySelectorAll(":scope .slide.has-sub > a").forEach((l) => {
                    var i;
                    l.nextElementSibling &&
                        ((i = l.nextElementSibling) == null ? void 0 : i.style.display) === "block" &&
                        H(l.nextElementSibling);
                }),
                xe(t.nextElementSibling);
        }
    });
});
let we, p;
(() => {
    let t = document.querySelector("html");
    (we = document.querySelector(".sidemenu-toggle")), we.addEventListener("click", f);
    let r = document.querySelector(".main-content");
    window.innerWidth <= 992 ? r.addEventListener("click", M) : r.removeEventListener("click", M),
        (p = [window.innerWidth]),
        A(),
        t.getAttribute("data-nav-layout") === "horizontal" && window.innerWidth >= 992
            ? (S(), r.addEventListener("click", S))
            : r.removeEventListener("click", S),
        window.addEventListener("resize", z),
        je(),
        !localStorage.getItem("zynixlayout") &&
            !localStorage.getItem("zynixnavstyles") &&
            !localStorage.getItem("zynixverticalstyles") &&
            !document.querySelector(".landing-body") &&
            document.querySelector("html").getAttribute("data-nav-layout") !== "horizontal" &&
            !t.getAttribute("data-vertical-style") &&
            !t.getAttribute("data-nav-style") &&
            N(),
        f(),
        t.getAttribute("data-vertical-style") === "detached" && t.removeAttribute("data-toggled"),
        (t.getAttribute("data-nav-style") === "menu-hover" || t.getAttribute("data-nav-style") === "icon-hover") &&
            window.innerWidth >= 992 &&
            S(),
        window.innerWidth < 992 && t.setAttribute("data-toggled", "close");
})();
function z() {
    let t = document.querySelector("html"),
        r = document.querySelector(".main-content");
    p.push(window.innerWidth),
        p.length > 2 && p.shift(),
        p.length > 1 &&
            (p[p.length - 1] < 992 &&
                p[p.length - 2] >= 992 &&
                (r.addEventListener("click", M), A(), f(), r.removeEventListener("click", S)),
            p[p.length - 1] >= 992 &&
                p[p.length - 2] < 992 &&
                (r.removeEventListener("click", M),
                f(),
                t.getAttribute("data-nav-layout") === "horizontal"
                    ? (S(), r.addEventListener("click", S))
                    : r.removeEventListener("click", S),
                document.documentElement.getAttribute("data-vertical-style") == "doublemenu"
                    ? document.querySelector(".double-menu-active")
                        ? t.setAttribute("data-toggled", "double-menu-open")
                        : t.setAttribute("data-toggled", "double-menu-close")
                    : t.removeAttribute("data-toggled"))),
        T();
}
function M() {
    document.querySelector("html").setAttribute("data-toggled", "close"),
        document.querySelector("#responsive-overlay").classList.remove("active");
}
function f() {
    let t = document.querySelector("html"),
        r = t.getAttribute("data-nav-layout");
    if (window.innerWidth >= 992) {
        if (r === "vertical") {
            switch (
                (b.removeEventListener("mouseenter", x),
                b.removeEventListener("mouseleave", E),
                b.removeEventListener("click", G),
                C.removeEventListener("click", W),
                document
                    .querySelectorAll(".main-menu li > .side-menu__item")
                    .forEach((n) => n.removeEventListener("click", F)),
                t.getAttribute("data-vertical-style"))
            ) {
                case "closed":
                    t.removeAttribute("data-nav-style"),
                        t.getAttribute("data-toggled") === "close-menu-close"
                            ? t.removeAttribute("data-toggled")
                            : t.setAttribute("data-toggled", "close-menu-close");
                    break;
                case "overlay":
                    t.removeAttribute("data-nav-style"),
                        t.getAttribute("data-toggled") === "icon-overlay-close"
                            ? (t.removeAttribute("data-toggled", "icon-overlay-close"),
                              b.removeEventListener("mouseenter", x),
                              b.removeEventListener("mouseleave", E))
                            : window.innerWidth >= 992
                              ? (localStorage.getItem("zynixlayout") ||
                                    t.setAttribute("data-toggled", "icon-overlay-close"),
                                b.addEventListener("mouseenter", x),
                                b.addEventListener("mouseleave", E))
                              : (b.removeEventListener("mouseenter", x), b.removeEventListener("mouseleave", E));
                    break;
                case "icontext":
                    t.removeAttribute("data-nav-style"),
                        t.getAttribute("data-toggled") === "icon-text-close"
                            ? (t.removeAttribute("data-toggled", "icon-text-close"),
                              b.removeEventListener("click", G),
                              C.removeEventListener("click", W))
                            : (t.setAttribute("data-toggled", "icon-text-close"),
                              window.innerWidth >= 992
                                  ? (b.addEventListener("click", G), C.addEventListener("click", W))
                                  : (b.removeEventListener("click", G), C.removeEventListener("click", W)));
                    break;
                case "doublemenu":
                    if ((t.removeAttribute("data-nav-style"), t.getAttribute("data-toggled") === "double-menu-open"))
                        t.setAttribute("data-toggled", "double-menu-close"),
                            document.querySelector(".slide-menu") &&
                                document.querySelectorAll(".slide-menu").forEach((s) => {
                                    s.classList.contains("double-menu-active") &&
                                        s.classList.remove("double-menu-active");
                                });
                    else {
                        let n = document.querySelector(".side-menu__item.active");
                        n &&
                            (t.setAttribute("data-toggled", "double-menu-open"),
                            n.nextElementSibling
                                ? n.nextElementSibling.classList.add("double-menu-active")
                                : document.querySelector("html").setAttribute("data-toggled", "double-menu-close"));
                    }
                    Xe();
                    break;
                case "detached":
                    t.getAttribute("data-toggled") === "detached-close"
                        ? (t.removeAttribute("data-toggled", "detached-close"),
                          b.removeEventListener("mouseenter", x),
                          b.removeEventListener("mouseleave", E))
                        : (t.setAttribute("data-toggled", "detached-close"),
                          window.innerWidth >= 992
                              ? (b.addEventListener("mouseenter", x), b.addEventListener("mouseleave", E))
                              : (b.removeEventListener("mouseenter", x), b.removeEventListener("mouseleave", E)));
                    break;
                case "default":
                    N(), t.removeAttribute("data-toggled");
                    break;
            }
            switch (t.getAttribute("data-nav-style")) {
                case "menu-click":
                    t.getAttribute("data-toggled") === "menu-click-closed"
                        ? t.removeAttribute("data-toggled")
                        : t.setAttribute("data-toggled", "menu-click-closed");
                    break;
                case "menu-hover":
                    t.getAttribute("data-toggled") === "menu-hover-closed"
                        ? (t.removeAttribute("data-toggled"), A())
                        : (t.setAttribute("data-toggled", "menu-hover-closed"), S());
                    break;
                case "icon-click":
                    t.getAttribute("data-toggled") === "icon-click-closed"
                        ? t.removeAttribute("data-toggled")
                        : t.setAttribute("data-toggled", "icon-click-closed");
                    break;
                case "icon-hover":
                    t.getAttribute("data-toggled") === "icon-hover-closed"
                        ? (t.removeAttribute("data-toggled"), A())
                        : (t.setAttribute("data-toggled", "icon-hover-closed"), S());
                    break;
            }
        }
    } else if (t.getAttribute("data-toggled") === "close") {
        t.setAttribute("data-toggled", "open");
        let o = document.createElement("div");
        (o.id = "responsive-overlay"),
            setTimeout(() => {
                document.querySelector("html").getAttribute("data-toggled") == "open" &&
                    (document.querySelector("#responsive-overlay").classList.add("active"),
                    document.querySelector("#responsive-overlay").addEventListener("click", () => {
                        document.querySelector("#responsive-overlay").classList.remove("active"), M();
                    })),
                    window.addEventListener("resize", () => {
                        window.innerWidth >= 992 &&
                            document.querySelector("#responsive-overlay").classList.remove("active");
                    });
            }, 100);
    } else t.setAttribute("data-toggled", "close");
}
function x() {
    document.querySelector("html").setAttribute("data-icon-overlay", "open");
}
function E() {
    document.querySelector("html").removeAttribute("data-icon-overlay");
}
function G() {
    document.querySelector("html").setAttribute("data-icon-text", "open");
}
function W() {
    document.querySelector("html").removeAttribute("data-icon-text");
}
function $e() {
    let t = document.querySelector("html");
    t.setAttribute("data-nav-layout", "vertical"),
        t.setAttribute("data-vertical-style", "closed"),
        t.removeAttribute("data-nav-style", ""),
        f();
}
function Ne() {
    let t = document.querySelector("html");
    t.setAttribute("data-nav-layout", "vertical"),
        t.setAttribute("data-vertical-style", "detached"),
        t.setAttribute("data-header-position", "fixed"),
        t.removeAttribute("data-nav-style", ""),
        f();
}
function Fe() {
    let t = document.querySelector("html");
    t.setAttribute("data-nav-layout", "vertical"),
        t.setAttribute("data-vertical-style", "icontext"),
        t.removeAttribute("data-nav-style", ""),
        f();
}
function N() {
    let t = document.querySelector("html");
    t.setAttribute("data-nav-layout", "vertical"),
        t.setAttribute("data-vertical-style", "overlay"),
        t.removeAttribute("data-nav-style", ""),
        f(),
        A();
}
function _e() {
    let t = document.querySelector("html");
    t.setAttribute("data-nav-layout", "vertical"),
        t.setAttribute("data-vertical-style", "doublemenu"),
        t.removeAttribute("data-nav-style", ""),
        f(),
        document.querySelectorAll(".main-menu > li > .side-menu__item");
    const r = document.createElement("div");
    (r.className = "custome-tooltip"),
        r.style.setProperty("position", "fixed"),
        r.style.setProperty("display", "none"),
        r.style.setProperty("padding", "0.5rem"),
        r.style.setProperty("font-weight", "500"),
        r.style.setProperty("font-size", "0.75rem"),
        r.style.setProperty("background-color", "rgb(15, 23 ,42)"),
        r.style.setProperty("color", "rgb(255, 255 ,255)"),
        r.style.setProperty("margin-inline-start", "135px"),
        r.style.setProperty("border-radius", "0.25rem"),
        r.style.setProperty("z-index", "99");
}
function De() {
    let t = document.querySelector("html");
    t.setAttribute("data-nav-style", "menu-click"),
        t.removeAttribute("data-hor-style"),
        t.removeAttribute("data-vertical-style"),
        f(),
        t.getAttribute("data-nav-layout") === "vertical" && A();
}
function Oe() {
    let t = document.querySelector("html");
    t.setAttribute("data-nav-style", "menu-hover"),
        t.removeAttribute("data-hor-style"),
        t.removeAttribute("data-vertical-style"),
        document.querySelectorAll(".slide.has-sub").forEach((o) => {
            o.addEventListener("mouseenter", Qe), o.addEventListener("mouseleave", Ke);
        }),
        f(),
        t.getAttribute("data-toggled") === "menu-hover-closed" && S();
}
function Ue() {
    let t = document.querySelector("html");
    t.setAttribute("data-nav-style", "icon-click"), f(), t.getAttribute("data-nav-layout") === "vertical" && A();
}
function Ve() {
    document.querySelector("html").setAttribute("data-nav-style", "icon-hover"), f(), S();
}
// function A() {
//     let t = window.location.pathname.split("/")[0];
//     (t = location.pathname == "/" ? "index" : location.pathname.substring(1)),
//         (t = t.substring(t.lastIndexOf("/") + 1)),
//         document.querySelectorAll(".side-menu__item").forEach((o) => {
//             if ((t === "/" && (t = "index"), o.getAttribute("href") === window.location.href)) {
//                 o.classList.add("active"), o.parentElement.classList.add("active");
//                 let l = o.closest("ul");
//                 if ((o.closest("ul:not(.main-menu)"), l)) {
//                     if (
//                         (l.classList.add("active"),
//                         l.previousElementSibling.classList.add("active"),
//                         l.parentElement.classList.add("active"),
//                         l.parentElement.classList.contains("has-sub"))
//                     ) {
//                         let i = l.parentElement.parentElement.parentElement;
//                         i.classList.add("open", "active"),
//                             i.firstElementChild.classList.add("active"),
//                             (i.children[1].style.display = "block"),
//                             Array.from(i.children[1].children).map((n) => {
//                                 n.classList.contains("active") && (n.children[1].style.display = "block");
//                             });
//                     }
//                     l.classList.contains("child1") && Ae(l),
//                         (l = l.parentElement.closest("ul")),
//                         l && l.closest("ul:not(.main-menu)") && l.closest("ul:not(.main-menu)");
//                 }
//             }
//         });
// }
function A() {
    // Find all menu items that Laravel marked as active
    document.querySelectorAll(".side-menu__item.active").forEach((item) => {
        // Mark the li as active
        let li = item.closest("li.slide");
        if (li) {
            li.classList.add("active");
        }

        // Find the submenu UL
        let submenu = item.closest("ul.slide-menu");
        if (submenu) {
            submenu.style.display = "block"; // keep it open
            submenu.classList.add("open");

            // Mark parent LI as open
            let parentLi = submenu.closest("li.slide.has-sub");
            if (parentLi) {
                parentLi.classList.add("open", "active");
            }
        }
    });
}

let R = document.querySelector(".slide.has-sub.open.active");
R &&
    document.querySelector(".child3 .side-menu__item.active") &&
    ((R.closest("ul.slide-menu").style.display = "block"),
    R.closest("ul.slide-menu").closest("li.slide.has-sub").classList.add("open"),
    R.closest("ul.slide-menu").closest("li.slide.has-sub").querySelector(".side-menu__item").classList.add("active"),
    R.closest("ul.slide-menu")
        .closest("li.slide.has-sub")
        .querySelector(".child2 .has-sub.active")
        .classList.add("open"));
var Le;
(Le = document.querySelector(".slide.has-sub.active .slide.has-sub.active")) == null || Le.classList.add("open");
function S() {
    document.querySelectorAll("ul.slide-menu").forEach((r) => {
        let o = r.closest("ul"),
            l = r.closest("ul:not(.main-menu)");
        if (o) {
            let i = o.closest("ul.main-menu");
            for (; i; )
                o.classList.add("active"),
                    H(o),
                    (o = o.parentElement.closest("ul")),
                    (l = o.closest("ul:not(.main-menu)")),
                    l || (i = !1);
        }
    });
}
function je() {
    let t = document.querySelector(".slide-left"),
        r = document.querySelector(".slide-right");
    function o() {
        let l = document.querySelectorAll(".slide"),
            i = document.querySelectorAll(".slide-menu");
        l.forEach((n, s) => {
            n.classList.contains("is-expanded") == !0 && n.classList.remove("is-expanded");
        }),
            i.forEach((n, s) => {
                n.classList.contains("open") == !0 && (n.classList.remove("open"), (n.style.display = "none"));
            });
    }
    T(),
        t.addEventListener("click", () => {
            let l = document.querySelector(".main-menu"),
                i = document.querySelector(".main-sidebar"),
                n = Math.ceil(Number(window.getComputedStyle(l).marginLeft.split("px")[0])),
                s = Math.ceil(Number(window.getComputedStyle(l).marginRight.split("px")[0])),
                m = i.offsetWidth;
            l.scrollWidth > i.offsetWidth
                ? document.querySelector("html").getAttribute("dir") !== "rtl"
                    ? n < 0 && !(Math.abs(n) < m)
                        ? ((l.style.marginRight = 0),
                          (l.style.marginLeft = Number(l.style.marginLeft.split("px")[0]) + Math.abs(m) + "px"),
                          r.classList.remove("d-none"))
                        : (n >= 0,
                          (l.style.marginLeft = "0px"),
                          t.classList.add("d-none"),
                          r.classList.remove("d-none"))
                    : s < 0 && !(Math.abs(s) < m)
                      ? ((l.style.marginLeft = 0),
                        (l.style.marginRight = Number(l.style.marginRight.split("px")[0]) + Math.abs(m) + "px"),
                        r.classList.remove("d-none"))
                      : (s >= 0, (l.style.marginRight = "0px"), t.classList.add("d-none"), r.classList.remove("d-none"))
                : ((document.querySelector(".main-menu").style.marginLeft = "0px"),
                  (document.querySelector(".main-menu").style.marginRight = "0px"),
                  t.classList.add("d-none"));
            let h = document.querySelector(".main-menu > .slide.open"),
                y = document.querySelector(".main-menu > .slide.open >ul");
            h && h.classList.remove("open"), y && (y.style.display = "none"), o();
        }),
        r.addEventListener("click", () => {
            let l = document.querySelector(".main-menu"),
                i = document.querySelector(".main-sidebar"),
                n = Math.ceil(Number(window.getComputedStyle(l).marginLeft.split("px")[0])),
                s = Math.ceil(Number(window.getComputedStyle(l).marginRight.split("px")[0])),
                m = l.scrollWidth - i.offsetWidth,
                h = i.offsetWidth;
            l.scrollWidth > i.offsetWidth &&
                (document.querySelector("html").getAttribute("dir") !== "rtl"
                    ? Math.abs(m) > Math.abs(n) &&
                      ((l.style.marginRight = 0),
                      Math.abs(m) > Math.abs(n) + h || ((h = Math.abs(m) - Math.abs(n)), r.classList.add("d-none")),
                      (l.style.marginLeft = Number(l.style.marginLeft.split("px")[0]) - Math.abs(h) + "px"),
                      t.classList.remove("d-none"))
                    : Math.abs(m) > Math.abs(s) &&
                      ((l.style.marginLeft = 0),
                      Math.abs(m) > Math.abs(s) + h || ((h = Math.abs(m) - Math.abs(s)), r.classList.add("d-none")),
                      (l.style.marginRight = Number(l.style.marginRight.split("px")[0]) - Math.abs(h) + "px"),
                      t.classList.remove("d-none")));
            let y = document.querySelector(".main-menu > .slide.open"),
                v = document.querySelector(".main-menu > .slide.open >ul");
            y && y.classList.remove("open"), v && (v.style.display = "none"), o();
        });
}
function T() {
    var m;
    let t = document.querySelector(".main-menu"),
        r = document.querySelector(".main-sidebar"),
        o = document.querySelector(".slide-left"),
        l = document.querySelector(".slide-right"),
        i = Math.ceil(Number(window.getComputedStyle(t).marginLeft.split("px")[0])),
        n = Math.ceil(Number(window.getComputedStyle(t).marginRight.split("px")[0])),
        s = t.scrollWidth - r.offsetWidth;
    if (
        (t.scrollWidth > r.offsetWidth
            ? (l.classList.remove("d-none"), o.classList.add("d-none"))
            : (l.classList.add("d-none"),
              o.classList.add("d-none"),
              (t.style.marginLeft = "0px"),
              (t.style.marginRight = "0px")),
        document.querySelector("html").getAttribute("data-nav-layout") === "horizontal" && window.innerWidth > 992)
    ) {
        document.querySelectorAll(".slide.has-sub.open > ul").forEach((u) => {
            let g = u,
                k = document.documentElement;
            const w = g.closest("li");
            var a = w.getBoundingClientRect(),
                q = g.getBoundingClientRect().width,
                B = a.right + q,
                I = a.left - q;
            k.getAttribute("dir") == "rtl"
                ? (u.classList.contains("child1") && a.left < 0 && S(),
                  I < 0 || (w.closest("ul").classList.contains("force-left") && B < window.innerWidth)
                      ? g.classList.add("force-left")
                      : g.classList.remove("force-left"))
                : (u.classList.contains("child1") && a.right > window.innerWidth && S(),
                  B > window.innerWidth || (w.closest("ul").classList.contains("force-left") && I > 0)
                      ? g.classList.add("force-left")
                      : (I < 0, g.classList.remove("force-left")));
        });
        let y = document.querySelector(".slide-menu.active.force-left");
        y &&
            (document.querySelector("html").getAttribute("dir") != "rtl"
                ? y.getBoundingClientRect().right < innerWidth
                    ? y.classList.remove("force-left")
                    : y.getBoundingClientRect().left < 0 &&
                      (document.documentElement.getAttribute("data-nav-style") == "menu-hover" ||
                          document.documentElement.getAttribute("data-nav-style") == "icon-hover" ||
                          window.innerWidth > 992) &&
                      e.classList.remove("force-left")
                : y.getBoundingClientRect().left -
                      ((m = y.parentElement.closest(".slide-menu")) == null ? void 0 : m.clientWidth) -
                      y.getBoundingClientRect().width >
                      0 &&
                  (document.documentElement.getAttribute("data-nav-style") == "menu-hover" ||
                      document.documentElement.getAttribute("data-nav-style") == "icon-hover" ||
                      window.innerWidth > 992) &&
                  y.classList.remove("force-left")),
            document.querySelectorAll(".main-menu .has-sub ul").forEach((u) => {
                if (Je(u)) {
                    let g = u.getBoundingClientRect();
                    document.documentElement.getAttribute("dir") == "rtl"
                        ? g.left < 0 &&
                          (u.classList.contains("child1")
                              ? u.classList.remove("force-left")
                              : u.classList.add("force-left"))
                        : g.right > innerWidth &&
                          (u.classList.contains("child1")
                              ? u.classList.remove("force-left")
                              : u.classList.add("force-left"));
                }
            });
    }
    document.querySelector("html").getAttribute("dir") !== "rtl"
        ? (t.scrollWidth > r.offsetWidth &&
              Math.abs(s) < Math.abs(i) &&
              ((t.style.marginLeft = -s + "px"), o.classList.remove("d-none"), l.classList.add("d-none")),
          i == 0 ? o.classList.add("d-none") : o.classList.remove("d-none"))
        : (t.scrollWidth > r.offsetWidth &&
              Math.abs(s) < Math.abs(n) &&
              ((t.style.marginRight = -s + "px"), o.classList.remove("d-none"), l.classList.add("d-none")),
          n == 0 ? o.classList.add("d-none") : o.classList.remove("d-none")),
        (i != 0 || n != 0) && o.classList.remove("d-none");
}
function Je(t) {
    return window.getComputedStyle(t).display != "none";
}
function Ke(t) {
    t.currentTarget.querySelector("ul").classList.remove("force-left");
}
function Qe(t) {
    let r = document.documentElement,
        o = t.currentTarget,
        l = o.querySelector("ul");
    if (
        o &&
        r.getAttribute("data-nav-layout") == "horizontal" &&
        (r.getAttribute("data-nav-style") == "menu-hover" || r.getAttribute("data-nav-style") == "icon-hover")
    ) {
        const h = o.closest("li");
        var i = h.getBoundingClientRect(),
            n = l.getBoundingClientRect().width,
            s = i.right + n,
            m = i.left - n;
        r.getAttribute("dir") == "rtl"
            ? m < 0 || (h.closest("ul").classList.contains("force-left") && s < window.innerWidth)
                ? l.classList.add("force-left")
                : l.classList.remove("force-left")
            : s > window.innerWidth || (h.closest("ul").classList.contains("force-left") && m > 0)
              ? l.classList.add("force-left")
              : (m < 0, l.classList.remove("force-left"));
    }
}
["switcher-icon-click", "switcher-icon-hover", "switcher-horizontal"].map((t) => {
    document.getElementById(t) &&
        document.getElementById(t).addEventListener("click", () => {
            let r = document.querySelector(".main-menu"),
                o = document.querySelector(".main-sidebar");
            setTimeout(() => {
                r.offsetWidth > o.offsetWidth
                    ? document.getElementById("slide-right").classList.remove("d-none")
                    : document.getElementById("slide-right").classList.add("d-none");
            }, 100);
        });
});
function Xe() {
    window.innerWidth >= 992 &&
        (document.querySelector("html"),
        document.querySelectorAll(".main-menu > li > .side-menu__item").forEach((r) => {
            r.addEventListener("click", F);
        }));
}
function F() {
    var t = this;
    let r = document.querySelector("html");
    var o = t.nextElementSibling;
    o &&
        (o.classList.contains("double-menu-active") ||
            (document.querySelector(".slide-menu") &&
                document.querySelectorAll(".slide-menu").forEach((i) => {
                    i.classList.contains("double-menu-active") &&
                        (i.classList.remove("double-menu-active"), r.setAttribute("data-toggled", "double-menu-close"));
                }),
            o.classList.add("double-menu-active"),
            r.setAttribute("data-toggled", "double-menu-open")));
}
window.addEventListener("unload", () => {
    document.querySelector(".main-content").removeEventListener("click", S),
        window.removeEventListener("resize", z),
        document.querySelectorAll(".main-menu li > .side-menu__item").forEach((o) => o.removeEventListener("click", F));
});
let Ye = () => {
    document.querySelectorAll(".side-menu__item").forEach((t) => {
        if (t.classList.contains("active")) {
            let r = t.getBoundingClientRect();
            t.children[0] &&
                t.parentElement.classList.contains("has-sub") &&
                r.top > 435 &&
                t.scrollIntoView({ behavior: "smooth" });
        }
    });
};
setTimeout(() => {
    Ye();
}, 300);
document.querySelector(".main-content").addEventListener("click", () => {
    document.querySelectorAll(".slide-menu").forEach((t) => {
        (document.querySelector("html").getAttribute("data-toggled") == "menu-click-closed" ||
            document.querySelector("html").getAttribute("data-toggled") == "icon-click-closed") &&
            (t.style.display = "none");
    });
});
let Ee;
(function () {
    document.querySelector("html"),
        (Ee = document.querySelector(".main-content")),
        document.querySelector("#switcher-canvas") &&
            (ot(),
            Ze(),
            L(),
            setTimeout(() => {
                L();
            }, 1e3));
})();
function Ze() {
    let t,
        r,
        o,
        l,
        i,
        n,
        s,
        m,
        h,
        y,
        v,
        u,
        g,
        k,
        w,
        a,
        q,
        B,
        I,
        _,
        D,
        O,
        U,
        V,
        j,
        J,
        K,
        Q,
        X,
        Y,
        Z,
        ee,
        te,
        re,
        le,
        oe,
        ce,
        ie,
        ne,
        ae,
        se,
        de,
        ue,
        me,
        ye,
        he,
        ge,
        be,
        Se,
        ve,
        fe,
        pe,
        ke,
        qe,
        c = document.querySelector("html");
    (i = document.querySelector("#switcher-light-theme")),
        (n = document.querySelector("#switcher-dark-theme")),
        (t = document.querySelector("#switcher-ltr")),
        (r = document.querySelector("#switcher-rtl")),
        (o = document.querySelector("#switcher-vertical")),
        (l = document.querySelector("#switcher-horizontal")),
        (m = document.querySelector("#switcher-default-width")),
        (s = document.querySelector("#switcher-boxed")),
        (h = document.querySelector("#switcher-full-width")),
        (g = document.querySelector("#switcher-menu-fixed")),
        (v = document.querySelector("#switcher-menu-scroll")),
        (u = document.querySelector("#switcher-header-fixed")),
        (y = document.querySelector("#switcher-header-scroll")),
        (k = document.querySelector("#switcher-header-light")),
        (w = document.querySelector("#switcher-header-dark")),
        (a = document.querySelector("#switcher-header-primary")),
        (q = document.querySelector("#switcher-header-gradient")),
        (U = document.querySelector("#switcher-header-transparent")),
        (B = document.querySelector("#switcher-menu-light")),
        (I = document.querySelector("#switcher-menu-dark")),
        (_ = document.querySelector("#switcher-menu-primary")),
        (D = document.querySelector("#switcher-menu-gradient")),
        (O = document.querySelector("#switcher-menu-transparent")),
        (V = document.querySelector("#switcher-regular")),
        (j = document.querySelector("#switcher-classic")),
        (J = document.querySelector("#switcher-modern")),
        (K = document.querySelector("#switcher-default-menu")),
        (te = document.querySelector("#switcher-menu-click")),
        (re = document.querySelector("#switcher-menu-hover")),
        (le = document.querySelector("#switcher-icon-click")),
        (oe = document.querySelector("#switcher-icon-hover")),
        (Q = document.querySelector("#switcher-closed-menu")),
        (X = document.querySelector("#switcher-icontext-menu")),
        (Z = document.querySelector("#switcher-icon-overlay")),
        (ee = document.querySelector("#switcher-double-menu")),
        (Y = document.querySelector("#switcher-detached")),
        document.querySelector("#resetbtn"),
        (ce = document.querySelector("#switcher-primary")),
        (ie = document.querySelector("#switcher-primary1")),
        (ne = document.querySelector("#switcher-primary2")),
        (ae = document.querySelector("#switcher-primary3")),
        (se = document.querySelector("#switcher-primary4")),
        (de = document.querySelector("#switcher-background")),
        (ue = document.querySelector("#switcher-background1")),
        (me = document.querySelector("#switcher-background2")),
        (ye = document.querySelector("#switcher-background3")),
        (he = document.querySelector("#switcher-background4")),
        (ge = document.querySelector("#switcher-bg-img")),
        (be = document.querySelector("#switcher-bg-img1")),
        (Se = document.querySelector("#switcher-bg-img2")),
        (ve = document.querySelector("#switcher-bg-img3")),
        (fe = document.querySelector("#switcher-bg-img4")),
        (pe = document.querySelector("#reset-all")),
        (ke = document.querySelector("#switcher-loader-enable")),
        (qe = document.querySelector("#switcher-loader-disable")),
        ce.addEventListener("click", () => {
            localStorage.setItem("primaryRGB", "130, 111, 255"), c.style.setProperty("--primary-rgb", "130, 111, 255");
        }),
        ie.addEventListener("click", () => {
            localStorage.setItem("primaryRGB", "48, 139, 211"), c.style.setProperty("--primary-rgb", "48, 139, 211");
        }),
        ne.addEventListener("click", () => {
            localStorage.setItem("primaryRGB", "0, 149, 140"), c.style.setProperty("--primary-rgb", "0, 149, 140");
        }),
        ae.addEventListener("click", () => {
            localStorage.setItem("primaryRGB", "138, 59, 203"), c.style.setProperty("--primary-rgb", "138, 59, 203");
        }),
        se.addEventListener("click", () => {
            localStorage.setItem("primaryRGB", "97, 110, 7"), c.style.setProperty("--primary-rgb", "97, 110, 7");
        }),
        de.addEventListener("click", () => {
            localStorage.setItem("bodyBgRGB", "53, 3, 141"),
                localStorage.setItem("bodylightRGB", "67, 19, 151"),
                c.setAttribute("data-theme-mode", "dark"),
                c.setAttribute("data-menu-styles", "dark"),
                c.setAttribute("data-header-styles", "dark"),
                document.querySelector("html").style.setProperty("--body-bg-rgb", localStorage.bodyBgRGB),
                document.querySelector("html").style.setProperty("--body-bg-rgb2", localStorage.bodylightRGB),
                document.querySelector("html").style.setProperty("--light-rgb", "67, 19, 151"),
                document.querySelector("html").style.setProperty("--form-control-bg", "rgb(67, 19, 151)"),
                document.querySelector("html").style.setProperty("--input-border", "rgba(255,255,255,0.1)"),
                document.querySelector("html").style.setProperty("--gray-3", "rgba(255,255,255,0.1)"),
                (document.querySelector("#switcher-dark-theme").checked = !0),
                (document.querySelector("#switcher-menu-dark").checked = !0),
                (document.querySelector("#switcher-header-dark").checked = !0),
                localStorage.setItem("zynixMenu", "dark"),
                localStorage.setItem("zynixHeader", "dark");
        }),
        ue.addEventListener("click", () => {
            localStorage.setItem("bodyBgRGB", "0, 84, 151"),
                localStorage.setItem("bodylightRGB", "22, 92, 149"),
                c.setAttribute("data-theme-mode", "dark"),
                c.setAttribute("data-menu-styles", "dark"),
                c.setAttribute("data-header-styles", "dark"),
                document.querySelector("html").style.setProperty("--body-bg-rgb", localStorage.bodyBgRGB),
                document.querySelector("html").style.setProperty("--body-bg-rgb2", localStorage.bodylightRGB),
                document.querySelector("html").style.setProperty("--light-rgb", "22, 92, 149"),
                document.querySelector("html").style.setProperty("--form-control-bg", "rgb(22, 92, 149)"),
                document.querySelector("html").style.setProperty("--input-border", "rgba(255,255,255,0.1)"),
                document.querySelector("html").style.setProperty("--gray-3", "rgba(255,255,255,0.1)"),
                (document.querySelector("#switcher-dark-theme").checked = !0),
                (document.querySelector("#switcher-menu-dark").checked = !0),
                (document.querySelector("#switcher-header-dark").checked = !0),
                localStorage.setItem("zynixMenu", "dark"),
                localStorage.setItem("zynixHeader", "dark");
        }),
        me.addEventListener("click", () => {
            localStorage.setItem("bodyBgRGB", "0, 86, 81"),
                localStorage.setItem("bodylightRGB", "0, 96, 91"),
                c.setAttribute("data-theme-mode", "dark"),
                c.setAttribute("data-menu-styles", "dark"),
                c.setAttribute("data-header-styles", "dark"),
                document.querySelector("html").style.setProperty("--body-bg-rgb", localStorage.bodyBgRGB),
                document.querySelector("html").style.setProperty("--body-bg-rgb2", localStorage.bodylightRGB),
                document.querySelector("html").style.setProperty("--light-rgb", "0, 96, 91"),
                document.querySelector("html").style.setProperty("--form-control-bg", "rgb(0, 96, 91)"),
                document.querySelector("html").style.setProperty("--input-border", "rgba(255,255,255,0.1)"),
                document.querySelector("html").style.setProperty("--gray-3", "rgba(255,255,255,0.1)"),
                (document.querySelector("#switcher-dark-theme").checked = !0),
                (document.querySelector("#switcher-menu-dark").checked = !0),
                (document.querySelector("#switcher-header-dark").checked = !0),
                localStorage.setItem("zynixMenu", "dark"),
                localStorage.setItem("zynixHeader", "dark");
        }),
        ye.addEventListener("click", () => {
            localStorage.setItem("bodyBgRGB", "73, 0, 133"),
                localStorage.setItem("bodylightRGB", "84, 16, 141"),
                c.setAttribute("data-theme-mode", "dark"),
                c.setAttribute("data-menu-styles", "dark"),
                c.setAttribute("data-header-styles", "dark"),
                document.querySelector("html").style.setProperty("--body-bg-rgb", localStorage.bodyBgRGB),
                document.querySelector("html").style.setProperty("--body-bg-rgb2", localStorage.bodylightRGB),
                document.querySelector("html").style.setProperty("--light-rgb", "84, 16, 141"),
                document.querySelector("html").style.setProperty("--form-control-bg", "rgb(84, 16, 141)"),
                document.querySelector("html").style.setProperty("--input-border", "rgba(255,255,255,0.1)"),
                document.querySelector("html").style.setProperty("--gray-3", "rgba(255,255,255,0.1)"),
                (document.querySelector("#switcher-dark-theme").checked = !0),
                (document.querySelector("#switcher-menu-dark").checked = !0),
                (document.querySelector("#switcher-header-dark").checked = !0),
                localStorage.setItem("zynixMenu", "dark"),
                localStorage.setItem("zynixHeader", "dark");
        }),
        he.addEventListener("click", () => {
            localStorage.setItem("bodyBgRGB", "45, 52, 0"),
                localStorage.setItem("bodylightRGB", "54, 62, 0"),
                c.setAttribute("data-theme-mode", "dark"),
                c.setAttribute("data-menu-styles", "dark"),
                c.setAttribute("data-header-styles", "dark"),
                document.querySelector("html").style.setProperty("--body-bg-rgb", localStorage.bodyBgRGB),
                document.querySelector("html").style.setProperty("--body-bg-rgb2", localStorage.bodylightRGB),
                document.querySelector("html").style.setProperty("--light-rgb", "54, 62, 0"),
                document.querySelector("html").style.setProperty("--form-control-bg", "rgb(54, 62, 0)"),
                document.querySelector("html").style.setProperty("--input-border", "rgba(255,255,255,0.1)"),
                document.querySelector("html").style.setProperty("--gray-3", "rgba(255,255,255,0.1)"),
                (document.querySelector("#switcher-dark-theme").checked = !0),
                (document.querySelector("#switcher-menu-dark").checked = !0),
                (document.querySelector("#switcher-header-dark").checked = !0),
                localStorage.setItem("zynixMenu", "dark"),
                localStorage.setItem("zynixHeader", "dark");
        }),
        ge.addEventListener("click", () => {
            c.setAttribute("data-bg-img", "bgimg1"), localStorage.setItem("bgimg", "bgimg1");
        }),
        be.addEventListener("click", () => {
            c.setAttribute("data-bg-img", "bgimg2"), localStorage.setItem("bgimg", "bgimg2");
        }),
        Se.addEventListener("click", () => {
            c.setAttribute("data-bg-img", "bgimg3"), localStorage.setItem("bgimg", "bgimg3");
        }),
        ve.addEventListener("click", () => {
            c.setAttribute("data-bg-img", "bgimg4"), localStorage.setItem("bgimg", "bgimg4");
        }),
        fe.addEventListener("click", () => {
            c.setAttribute("data-bg-img", "bgimg5"), localStorage.setItem("bgimg", "bgimg5");
        }),
        i.addEventListener("click", () => {
            ze(),
                localStorage.setItem("zynixHeader", "light"),
                localStorage.removeItem("bodylightRGB"),
                localStorage.removeItem("bodyBgRGB"),
                localStorage.removeItem("zynixMenu"),
                c.getAttribute("data-nav-layout") === "horizontal" && c.setAttribute("data-header-styles", "light");
        }),
        n.addEventListener("click", () => {
            tt(),
                localStorage.setItem("zynixMenu", "dark"),
                localStorage.setItem("zynixHeader", "dark"),
                c.getAttribute("data-nav-layout") === "horizontal" && c.setAttribute("data-header-styles", "dark");
        }),
        B.addEventListener("click", () => {
            c.setAttribute("data-menu-styles", "light"), localStorage.setItem("zynixMenu", "light");
        }),
        _.addEventListener("click", () => {
            c.setAttribute("data-menu-styles", "color"), localStorage.setItem("zynixMenu", "color");
        }),
        I.addEventListener("click", () => {
            c.setAttribute("data-menu-styles", "dark"), localStorage.setItem("zynixMenu", "dark");
        }),
        D.addEventListener("click", () => {
            c.setAttribute("data-menu-styles", "gradient"), localStorage.setItem("zynixMenu", "gradient");
        }),
        O.addEventListener("click", () => {
            c.setAttribute("data-menu-styles", "transparent"), localStorage.setItem("zynixMenu", "transparent");
        }),
        k.addEventListener("click", () => {
            c.setAttribute("data-header-styles", "light"), localStorage.setItem("zynixHeader", "light");
        }),
        a.addEventListener("click", () => {
            c.setAttribute("data-header-styles", "color"), localStorage.setItem("zynixHeader", "color");
        }),
        w.addEventListener("click", () => {
            c.setAttribute("data-header-styles", "dark"), localStorage.setItem("zynixHeader", "dark");
        }),
        q.addEventListener("click", () => {
            c.setAttribute("data-header-styles", "gradient"), localStorage.setItem("zynixHeader", "gradient");
        }),
        U.addEventListener("click", () => {
            c.setAttribute("data-header-styles", "transparent"), localStorage.setItem("zynixHeader", "transparent");
        }),
        m.addEventListener("click", () => {
            c.setAttribute("data-width", "default"),
                localStorage.setItem("zynixdefaultwidth", !0),
                localStorage.removeItem("zynixboxed"),
                localStorage.removeItem("zynixfullwidth");
        }),
        h.addEventListener("click", () => {
            c.setAttribute("data-width", "fullwidth"),
                localStorage.setItem("zynixfullwidth", !0),
                localStorage.removeItem("zynixboxed"),
                localStorage.removeItem("zynixdefaultwidth");
        }),
        s.addEventListener("click", () => {
            c.setAttribute("data-width", "boxed"),
                localStorage.setItem("zynixboxed", !0),
                localStorage.removeItem("zynixfullwidth"),
                localStorage.removeItem("zynixdefaultwidth"),
                T();
        }),
        V.addEventListener("click", () => {
            c.setAttribute("data-page-style", "regular"),
                localStorage.setItem("zynixregular", !0),
                localStorage.removeItem("zynixclassic"),
                localStorage.removeItem("zynixmodern");
        }),
        j.addEventListener("click", () => {
            c.setAttribute("data-page-style", "classic"),
                localStorage.setItem("zynixclassic", !0),
                localStorage.removeItem("zynixregular"),
                localStorage.removeItem("zynixmodern");
        }),
        J.addEventListener("click", () => {
            c.setAttribute("data-page-style", "modern"),
                localStorage.setItem("zynixmodern", !0),
                localStorage.removeItem("zynixregular"),
                localStorage.removeItem("zynixclassic");
        }),
        u.addEventListener("click", () => {
            c.setAttribute("data-header-position", "fixed"),
                localStorage.setItem("zynixheaderfixed", !0),
                localStorage.removeItem("zynixheaderscrollable");
        }),
        y.addEventListener("click", () => {
            c.setAttribute("data-header-position", "scrollable"),
                localStorage.setItem("zynixheaderscrollable", !0),
                localStorage.removeItem("zynixheaderfixed");
        }),
        g.addEventListener("click", () => {
            c.setAttribute("data-menu-position", "fixed"),
                localStorage.setItem("zynixmenufixed", !0),
                localStorage.removeItem("zynixmenuscrollable");
        }),
        v.addEventListener("click", () => {
            c.setAttribute("data-menu-position", "scrollable"),
                localStorage.setItem("zynixmenuscrollable", !0),
                localStorage.removeItem("zynixmenufixed");
        }),
        K.addEventListener("click", () => {
            c.setAttribute("data-vertical-style", "default"),
                c.setAttribute("data-nav-layout", "vertical"),
                f(),
                localStorage.removeItem("zynixverticalstyles"),
                localStorage.removeItem("zynixnavstyles"),
                document.querySelectorAll(".main-menu>li.open").forEach((d) => {
                    d.classList.contains("active") ||
                        (d.classList.remove("open"), (d.querySelector("ul").style.display = "none"));
                });
        }),
        Q.addEventListener("click", () => {
            $e(),
                localStorage.setItem("zynixverticalstyles", "closed"),
                document.querySelectorAll(".main-menu>li.open").forEach((d) => {
                    d.classList.contains("active") ||
                        (d.classList.remove("open"), (d.querySelector("ul").style.display = "none"));
                });
        }),
        Y.addEventListener("click", () => {
            Ne(), localStorage.setItem("zynixverticalstyles", "detached");
        }),
        X.addEventListener("click", () => {
            Fe(), localStorage.setItem("zynixverticalstyles", "icontext");
        }),
        Z.addEventListener("click", () => {
            N(),
                localStorage.setItem("zynixverticalstyles", "overlay"),
                document.querySelectorAll(".main-menu>li.open").forEach((d) => {
                    d.classList.contains("active") ||
                        (d.classList.remove("open"), (d.querySelector("ul").style.display = "none"));
                });
        }),
        ee.addEventListener("click", () => {
            _e(), localStorage.setItem("zynixverticalstyles", "doublemenu");
        }),
        te.addEventListener("click", () => {
            c.removeAttribute("data-vertical-style"),
                De(),
                localStorage.setItem("zynixnavstyles", "menu-click"),
                localStorage.removeItem("zynixverticalstyles"),
                document.querySelectorAll(".main-menu>li.open").forEach((d) => {
                    d.classList.contains("active") ||
                        (d.classList.remove("open"), (d.querySelector("ul").style.display = "none"));
                }),
                document.querySelector("html").getAttribute("data-nav-layout") == "horizontal" &&
                    ((document.querySelector(".main-menu").style.marginLeft = "0px"),
                    (document.querySelector(".main-menu").style.marginRight = "0px"),
                    z());
        }),
        re.addEventListener("click", () => {
            c.removeAttribute("data-vertical-style"),
                Oe(),
                localStorage.setItem("zynixnavstyles", "menu-hover"),
                localStorage.removeItem("zynixverticalstyles"),
                document.querySelector("html").getAttribute("data-nav-layout") == "horizontal" &&
                    ((document.querySelector(".main-menu").style.marginLeft = "0px"),
                    (document.querySelector(".main-menu").style.marginRight = "0px"),
                    z());
        }),
        le.addEventListener("click", () => {
            c.removeAttribute("data-vertical-style"),
                Ue(),
                localStorage.setItem("zynixnavstyles", "icon-click"),
                localStorage.removeItem("zynixverticalstyles"),
                document.querySelector("html").getAttribute("data-nav-layout") == "horizontal" &&
                    ((document.querySelector(".main-menu").style.marginLeft = "0px"),
                    (document.querySelector(".main-menu").style.marginRight = "0px"),
                    z(),
                    document.querySelector("#slide-left").classList.add("d-none")),
                document.querySelectorAll(".main-menu>li.open").forEach((d) => {
                    d.classList.contains("active") ||
                        (d.classList.remove("open"), (d.querySelector("ul").style.display = "none"));
                });
        }),
        oe.addEventListener("click", () => {
            c.removeAttribute("data-vertical-style"),
                Ve(),
                localStorage.setItem("zynixnavstyles", "icon-hover"),
                localStorage.removeItem("zynixverticalstyles"),
                document.querySelector("html").getAttribute("data-nav-layout") == "horizontal" &&
                    ((document.querySelector(".main-menu").style.marginLeft = "0px"),
                    (document.querySelector(".main-menu").style.marginRight = "0px"),
                    z(),
                    document.querySelector("#slide-left").classList.add("d-none"));
        }),
        o.addEventListener("click", () => {
            let d = document.querySelector(".main-content");
            localStorage.removeItem("zynixlayout"),
                localStorage.setItem("zynixverticalstyles", "fullwidth"),
                Be(),
                A(),
                d.removeEventListener("click", S),
                (document.querySelector(".main-menu").style.marginLeft = "0px"),
                (document.querySelector(".main-menu").style.marginRight = "0px"),
                document.querySelectorAll(".slide").forEach(($) => {
                    $.classList.contains("open") &&
                        !$.classList.contains("active") &&
                        ($.querySelector("ul").style.display = "none");
                });
        }),
        l.addEventListener("click", () => {
            let d = document.querySelector(".main-content");
            c.removeAttribute("data-vertical-style"),
                localStorage.setItem("zynixlayout", "horizontal"),
                localStorage.removeItem("zynixverticalstyles"),
                c.getAttribute("data-nav-layout") === "horizontal" &&
                    (c.getAttribute("data-theme-mode") === "light"
                        ? c.setAttribute("data-header-styles", "light")
                        : c.getAttribute("data-theme-mode") === "dark" && c.setAttribute("data-header-styles", "dark")),
                rt(),
                S(),
                d.addEventListener("click", S);
        }),
        r.addEventListener("click", () => {
            localStorage.setItem("zynixrtl", !0),
                localStorage.removeItem("zynixltr"),
                et(),
                document.querySelector(".noUi-target") &&
                    (console.log("working"),
                    document.querySelectorAll(".noUi-origin").forEach((d) => {
                        d.classList.add("transform-none");
                    }));
        }),
        t.addEventListener("click", () => {
            localStorage.setItem("zynixltr", !0),
                localStorage.removeItem("zynixrtl"),
                Ie(),
                document.querySelector(".noUi-target") &&
                    document.querySelectorAll(".noUi-origin").forEach((d) => {
                        d.classList.remove("transform-none");
                    });
        }),
        pe.addEventListener("click", () => {
            lt(),
                A(),
                document.querySelector("html").setAttribute("data-menu-styles", "light"),
                document.querySelector("html").setAttribute("data-width", "fullwidth"),
                (document.querySelector("#switcher-menu-light").checked = !0),
                document.querySelectorAll(".slide").forEach((d) => {
                    d.classList.contains("open") &&
                        !d.classList.contains("active") &&
                        (d.querySelector("ul").style.display = "none");
                });
        }),
        (ke.onclick = () => {
            document.querySelector("html").setAttribute("loader", "enable"),
                localStorage.setItem("loaderEnable", "true");
        }),
        (qe.onclick = () => {
            document.querySelector("html").setAttribute("loader", "disable"),
                localStorage.setItem("loaderEnable", "false");
        });
}
function Ie() {
    var r;
    let t = document.querySelector("html");
    document.querySelector("#style").href.includes("bootstrap.min.css") ||
        (r = document.querySelector("#style")) == null ||
        r.setAttribute("href", "https://laravelui.spruko.com/zynix/build/assets/libs/bootstrap/css/bootstrap.min.css"),
        t.setAttribute("dir", "ltr"),
        (document.querySelector("#switcher-ltr").checked = !0),
        L();
}
function et() {
    var r;
    document.querySelector("html").setAttribute("dir", "rtl"),
        (r = document.querySelector("#style")) == null ||
            r.setAttribute(
                "href",
                "https://laravelui.spruko.com/zynix/build/assets/libs/bootstrap/css/bootstrap.rtl.min.css"
            ),
        L();
}
function ze() {
    let t = document.querySelector("html");
    t.setAttribute("data-theme-mode", "light"),
        t.setAttribute("data-header-styles", "light"),
        t.setAttribute("data-menu-styles", "light"),
        localStorage.getItem("primaryRGB") || t.setAttribute("style", ""),
        (document.querySelector("#switcher-light-theme").checked = !0),
        (document.querySelector("#switcher-menu-light").checked = !0),
        (document.querySelector("#switcher-header-light").checked = !0),
        localStorage.removeItem("zynixdarktheme"),
        localStorage.removeItem("zynixbgColor"),
        localStorage.removeItem("zynixheaderbg"),
        localStorage.removeItem("zynixbgwhite"),
        localStorage.removeItem("zynixmenubg"),
        localStorage.removeItem("zynixmenubg"),
        L(),
        t.style.removeProperty("--body-bg-rgb"),
        t.style.removeProperty("--body-bg-rgb2"),
        t.style.removeProperty("--light-rgb"),
        t.style.removeProperty("--form-control-bg"),
        t.style.removeProperty("--gray-3"),
        t.style.removeProperty("--input-border"),
        (document.querySelector("#switcher-background4").checked = !1),
        (document.querySelector("#switcher-background3").checked = !1),
        (document.querySelector("#switcher-background2").checked = !1),
        (document.querySelector("#switcher-background1").checked = !1),
        (document.querySelector("#switcher-background").checked = !1),
        (document.querySelector("#switcher-menu-light").checked = !0),
        (document.querySelector("#switcher-header-light").checked = !0);
}
function tt() {
    let t = document.querySelector("html");
    t.setAttribute("data-theme-mode", "dark"),
        t.setAttribute("data-header-styles", "dark"),
        t.setAttribute("data-menu-styles", "dark"),
        localStorage.getItem("primaryRGB") || t.setAttribute("style", ""),
        (document.querySelector("#switcher-menu-dark").checked = !0),
        (document.querySelector("#switcher-header-dark").checked = !0),
        document.querySelector("html").style.removeProperty("--body-bg-rgb"),
        document.querySelector("html").style.removeProperty("--body-bg-rgb2"),
        document.querySelector("html").style.removeProperty("--light-rgb"),
        document.querySelector("html").style.removeProperty("--form-control-bg"),
        document.querySelector("html").style.removeProperty("--gray-3"),
        document.querySelector("html").style.removeProperty("--input-border"),
        localStorage.setItem("zynixdarktheme", !0),
        localStorage.removeItem("zynixlighttheme"),
        localStorage.removeItem("bodyBgRGB"),
        localStorage.removeItem("zynixbgColor"),
        localStorage.removeItem("zynixheaderbg"),
        localStorage.removeItem("zynixbgwhite"),
        localStorage.removeItem("zynixmenubg"),
        L(),
        (document.querySelector("#switcher-background4").checked = !1),
        (document.querySelector("#switcher-background3").checked = !1),
        (document.querySelector("#switcher-background2").checked = !1),
        (document.querySelector("#switcher-background1").checked = !1),
        (document.querySelector("#switcher-background").checked = !1),
        (document.querySelector("#switcher-menu-dark").checked = !0),
        (document.querySelector("#switcher-header-dark").checked = !0);
}
function Be() {
    let t = document.querySelector("html");
    t.setAttribute("data-nav-layout", "vertical"),
        t.setAttribute("data-vertical-style", "overlay"),
        t.removeAttribute("data-nav-style"),
        localStorage.removeItem("zynixnavstyles"),
        t.removeAttribute("data-toggled"),
        (document.querySelector("#switcher-vertical").checked = !0),
        (document.querySelector("#switcher-menu-click").checked = !1),
        (document.querySelector("#switcher-menu-hover").checked = !1),
        (document.querySelector("#switcher-icon-click").checked = !1),
        (document.querySelector("#switcher-icon-hover").checked = !1),
        L();
}
function rt() {
    (document.querySelector("#switcher-horizontal").checked = !0),
        (document.querySelector("#switcher-menu-click").checked = !0);
    let t = document.querySelector("html");
    t.setAttribute("data-nav-layout", "horizontal"),
        t.removeAttribute("data-vertical-style"),
        t.getAttribute("data-nav-style") || t.setAttribute("data-nav-style", "menu-click"),
        !localStorage.zynixMenu &&
            !localStorage.bodylightRGB &&
            (t.setAttribute("data-menu-styles", "light"),
            (document.querySelector("#switcher-menu-light").checked = !0),
            L()),
        L(),
        T();
}
function lt() {
    let t = document.querySelector("html");
    localStorage.getItem("zynixlayout") == "horizontal" &&
        (document.querySelector(".main-menu").style.display = "block"),
        L(),
        localStorage.clear(),
        ze(),
        document.querySelector("html").removeAttribute("style"),
        t.removeAttribute("data-nav-style"),
        t.removeAttribute("data-menu-position"),
        t.removeAttribute("data-header-position"),
        t.removeAttribute("data-page-style"),
        t.removeAttribute("data-bg-img"),
        t.style.removeProperty("--primary-rgb"),
        t.style.removeProperty("--body-bg-rgb"),
        Ie(),
        Be(),
        Ee.removeEventListener("click", S),
        (document.querySelector("#switcher-classic").checked = !1),
        (document.querySelector("#switcher-modern").checked = !1),
        (document.querySelector("#switcher-regular").checked = !0),
        (document.querySelector("#switcher-default-width").checked = !1),
        (document.querySelector("#switcher-full-width").checked = !0),
        (document.querySelector("#switcher-boxed").checked = !1),
        (document.querySelector("#switcher-menu-fixed").checked = !0),
        (document.querySelector("#switcher-menu-scroll").checked = !1),
        (document.querySelector("#switcher-header-fixed").checked = !0),
        (document.querySelector("#switcher-header-scroll").checked = !1),
        (document.querySelector("#switcher-default-menu").checked = !0),
        (document.querySelector("#switcher-closed-menu").checked = !1),
        (document.querySelector("#switcher-icontext-menu").checked = !1),
        (document.querySelector("#switcher-icon-overlay").checked = !1),
        (document.querySelector("#switcher-detached").checked = !1),
        (document.querySelector("#switcher-double-menu").checked = !1),
        (document.querySelector("#switcher-primary").checked = !1),
        (document.querySelector("#switcher-primary1").checked = !1),
        (document.querySelector("#switcher-primary2").checked = !1),
        (document.querySelector("#switcher-primary3").checked = !1),
        (document.querySelector("#switcher-primary4").checked = !1),
        (document.querySelector("#switcher-background").checked = !1),
        (document.querySelector("#switcher-background1").checked = !1),
        (document.querySelector("#switcher-background2").checked = !1),
        (document.querySelector("#switcher-background3").checked = !1),
        (document.querySelector("#switcher-background4").checked = !1),
        (document.querySelector(".main-menu").style.marginLeft = "0px"),
        (document.querySelector(".main-menu").style.marginRight = "0px");
}
function L() {
    if (
        (localStorage.getItem("zynixdarktheme") && (document.querySelector("#switcher-dark-theme").checked = !0),
        localStorage.getItem("zynixlayout") === "horizontal"
            ? ((document.querySelector("#switcher-horizontal").checked = !0),
              (document.querySelector("#switcher-menu-click").checked = !0))
            : (document.querySelector("#switcher-vertical").checked = !0),
        localStorage.getItem("zynixrtl")
            ? (document.querySelector("#switcher-rtl").checked = !0)
            : (document.querySelector("#switcher-ltr").checked = !0),
        localStorage.getItem("zynixHeader") === "light" &&
            (document.querySelector("#switcher-header-light").checked = !0),
        localStorage.getItem("zynixHeader") === "color" &&
            (document.querySelector("#switcher-header-primary").checked = !0),
        localStorage.getItem("zynixHeader") === "gradient" &&
            (document.querySelector("#switcher-header-gradient").checked = !0),
        localStorage.getItem("zynixHeader") === "dark" &&
            (document.querySelector("#switcher-header-dark").checked = !0),
        localStorage.getItem("zynixHeader") === "transparent" &&
            (document.querySelector("#switcher-header-transparent").checked = !0),
        localStorage.getItem("zynixMenu") === "light" && (document.querySelector("#switcher-menu-light").checked = !0),
        localStorage.getItem("zynixMenu") === "color" &&
            (document.querySelector("#switcher-menu-primary").checked = !0),
        localStorage.getItem("zynixMenu") === "gradient" &&
            (document.querySelector("#switcher-menu-gradient").checked = !0),
        localStorage.getItem("zynixMenu") === "dark" && (document.querySelector("#switcher-menu-dark").checked = !0),
        localStorage.getItem("zynixMenu") === "transparent" &&
            (document.querySelector("#switcher-menu-transparent").checked = !0),
        localStorage.getItem("zynixdefaultwidth") && (document.querySelector("#switcher-default-width").checked = !0),
        localStorage.getItem("zynixfullwidth") && (document.querySelector("#switcher-full-width").checked = !0),
        localStorage.getItem("zynixboxed") && (document.querySelector("#switcher-boxed").checked = !0),
        localStorage.getItem("zynixheaderscrollable") &&
            (document.querySelector("#switcher-header-scroll").checked = !0),
        localStorage.getItem("zynixmenuscrollable") && (document.querySelector("#switcher-menu-scroll").checked = !0),
        localStorage.getItem("zynixheaderfixed") && (document.querySelector("#switcher-header-fixed").checked = !0),
        localStorage.getItem("zynixmenufixed") && (document.querySelector("#switcher-menu-fixed").checked = !0),
        localStorage.getItem("zynixclassic") && (document.querySelector("#switcher-classic").checked = !0),
        localStorage.getItem("zynixmodern") && (document.querySelector("#switcher-modern").checked = !0),
        localStorage.zynixverticalstyles)
    )
        switch (localStorage.getItem("zynixverticalstyles")) {
            case "default":
                document.querySelector("#switcher-default-menu").checked = !0;
                break;
            case "closed":
                document.querySelector("#switcher-closed-menu").checked = !0;
                break;
            case "icontext":
                document.querySelector("#switcher-icontext-menu").checked = !0;
                break;
            case "overlay":
                document.querySelector("#switcher-icon-overlay").checked = !0;
                break;
            case "detached":
                document.querySelector("#switcher-detached").checked = !0;
                break;
            case "doublemenu":
                document.querySelector("#switcher-double-menu").checked = !0;
                break;
            default:
                document.querySelector("#switcher-default-menu").checked = !0;
                break;
        }
    if (localStorage.zynixnavstyles)
        switch (localStorage.getItem("zynixnavstyles")) {
            case "menu-click":
                document.querySelector("#switcher-menu-click").checked = !0;
                break;
            case "menu-hover":
                document.querySelector("#switcher-menu-hover").checked = !0;
                break;
            case "icon-click":
                document.querySelector("#switcher-icon-click").checked = !0;
                break;
            case "icon-hover":
                document.querySelector("#switcher-icon-hover").checked = !0;
                break;
        }
    localStorage.loaderEnable != "true" && (document.querySelector("#switcher-loader-disable").checked = !0);
}
if (document.querySelector("#switcher-canvas")) {
    const t = document.querySelector(".pickr-container-primary"),
        r = document.querySelector(".theme-container-primary"),
        o = document.querySelector(".pickr-container-background"),
        l = document.querySelector(".theme-container-background"),
        i = [
            [
                "nano",
                {
                    defaultRepresentation: "RGB",
                    components: {
                        preview: !0,
                        opacity: !1,
                        hue: !0,
                        interaction: { hex: !1, rgba: !0, hsva: !1, input: !0, clear: !1, save: !1 },
                    },
                },
            ],
        ],
        n = [];
    let s = null;
    for (const [y, v] of i) {
        const u = document.createElement("button");
        (u.innerHTML = y),
            n.push(u),
            u.addEventListener("click", () => {
                const g = document.createElement("p");
                t.appendChild(g), s && s.destroyAndRemove();
                for (const k of n) k.classList[k === u ? "add" : "remove"]("active");
                (s = new Pickr(Object.assign({ el: g, theme: y, default: "#735dff" }, v))),
                    s.on("changestop", (k, w) => {
                        let a = w.getColor().toRGBA();
                        document
                            .querySelector("html")
                            .style.setProperty(
                                "--primary-rgb",
                                `${Math.floor(a[0])}, ${Math.floor(a[1])}, ${Math.floor(a[2])}`
                            ),
                            localStorage.setItem(
                                "primaryRGB",
                                `${Math.floor(a[0])}, ${Math.floor(a[1])}, ${Math.floor(a[2])}`
                            );
                    });
            }),
            r.appendChild(u);
    }
    n[0].click();
    const m = [];
    let h = null;
    for (const [y, v] of i) {
        const u = document.createElement("button");
        (u.innerHTML = y),
            m.push(u),
            u.addEventListener("click", () => {
                const g = document.createElement("p");
                o.appendChild(g), h && h.destroyAndRemove();
                for (const k of n) k.classList[k === u ? "add" : "remove"]("active");
                (h = new Pickr(Object.assign({ el: g, theme: y, default: "#735dff" }, v))),
                    h.on("changestop", (k, w) => {
                        let a = w.getColor().toRGBA(),
                            q = document.querySelector("html");
                        q.style.setProperty("--body-bg-rgb", `${a[0]}, ${a[1]}, ${a[2]}`),
                            document
                                .querySelector("html")
                                .style.setProperty("--body-bg-rgb2", `${a[0] + 14}, ${a[1] + 14}, ${a[2] + 14}`),
                            document
                                .querySelector("html")
                                .style.setProperty("--light-rgb", `${a[0] + 14}, ${a[1] + 14}, ${a[2] + 14}`),
                            document
                                .querySelector("html")
                                .style.setProperty(
                                    "--form-control-bg",
                                    `rgb(${a[0] + 14}, ${a[1] + 14}, ${a[2] + 14})`
                                ),
                            document
                                .querySelector("html")
                                .style.setProperty("--gray-3", `rgb(${a[0] + 14}, ${a[1] + 14}, ${a[2] + 14})`),
                            localStorage.removeItem("bgtheme"),
                            q.setAttribute("data-theme-mode", "dark"),
                            q.setAttribute("data-menu-styles", "dark"),
                            q.setAttribute("data-header-styles", "dark"),
                            (document.querySelector("#switcher-dark-theme").checked = !0),
                            localStorage.setItem("bodyBgRGB", `${a[0]}, ${a[1]}, ${a[2]}`),
                            localStorage.setItem("bodylightRGB", `${a[0] + 14}, ${a[1] + 14}, ${a[2] + 14}`);
                    });
            }),
            l.appendChild(u);
    }
    m[0].click();
}
function ot() {
    (localStorage.bodyBgRGB || localStorage.bodylightRGB) &&
        ((document.querySelector("#switcher-dark-theme").checked = !0),
        (document.querySelector("#switcher-menu-dark").checked = !0),
        (document.querySelector("#switcher-header-dark").checked = !0)),
        localStorage.bodyBgRGB &&
            localStorage.bodylightRGB &&
            (localStorage.bodyBgRGB == "53, 3, 141" && (document.querySelector("#switcher-background").checked = !0),
            localStorage.bodyBgRGB == "34, 120, 174" && (document.querySelector("#switcher-background1").checked = !0),
            localStorage.bodyBgRGB == "0, 86, 81" && (document.querySelector("#switcher-background2").checked = !0),
            localStorage.bodyBgRGB == "73, 0, 133" && (document.querySelector("#switcher-background3").checked = !0),
            localStorage.bodyBgRGB == "45, 52, 0" && (document.querySelector("#switcher-background4").checked = !0)),
        localStorage.primaryRGB &&
            (localStorage.primaryRGB == "130, 111, 255" && (document.querySelector("#switcher-primary").checked = !0),
            localStorage.primaryRGB == "48, 139, 211" && (document.querySelector("#switcher-primary1").checked = !0),
            localStorage.primaryRGB == "0, 149, 140" && (document.querySelector("#switcher-primary2").checked = !0),
            localStorage.primaryRGB == "138, 59, 203" && (document.querySelector("#switcher-primary3").checked = !0),
            localStorage.primaryRGB == "97, 110, 7" && (document.querySelector("#switcher-primary4").checked = !0)),
        localStorage.loaderEnable == "true" && (document.querySelector("#switcher-loader-enable").checked = !0);
}
