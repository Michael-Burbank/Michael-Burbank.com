(function () {
	("use strict");

	/**
	 * Easy selector helper function
	 */ 
	const select = (el, all = false) => {
		el = el.trim();
		if (all) {
			return [...document.querySelectorAll(el)];
		} else {
			return document.querySelector(el);
		}
	};

	/**
	 * Easy event listener function
	 */


	const on = (type, el, listener, all = false) => {
		let selectEl = select(el, all);

		if(selectEl){
			if(all){
				selectEl.forEach((e) => e.addEventListener(type, listener));
			} else {
				selectEl.addEventListener(type, listener);
			}
		}
	};

	/**
	 * Easy on scroll event listener
	 */
	const onscroll = (el, listener) => {
		el.addEventListener("scroll", listener);
	};

	/**
	 * Navbar links active state on scroll
	 *
	 */
	let navbarlinks = select("#navbar .scrollto", true);
	const navbarlinksActive = () => {
		let position = window.scrollY + 200;
		navbarlinks.forEach((navbarlink) => {
			if (!navbarlink.hash) return;
			let section = select(navbarlink.hash);
			if (!section) return;
			if (
				position >= section.offsetTop &&
				position <= section.offsetTop + section.offsetHeight
			) {
				navbarlink.classList.add("active");
			} else {
				navbarlink.classList.remove("active");
			}
		});
	};
	window.addEventListener("load", navbarlinksActive);
	onscroll(document, navbarlinksActive);

	/**
	 * Scrolls to an element with header offset
	 */
	const scrollto = (el) => {
		let elementPos = select(el).offsetTop;
		window.scrollTo({
			top: elementPos,
			behavior: "smooth",
		});
	};



	/**
	 * Back to top button
	 */
	let backtotop = select(".back-to-top");
	if (backtotop) {
		const toggleBacktotop = () => {
			if (window.scrollY > 100) {
				backtotop.classList.add("active");
			} else {
				backtotop.classList.remove("active");
			}
		};
		window.addEventListener("load", toggleBacktotop);
		onscroll(document, toggleBacktotop);
	}

	/**
	 * Mobile nav toggle
	 */
	on("click", ".mobile-nav-toggle", function (e) {
		select("body").classList.toggle("mobile-nav-active");
		this.classList.toggle("bi-list");
		this.classList.toggle("bi-x");
	});

	/**
	 * Scroll with offset on links with a class name .scrollto
	 */
	on(
		"click",
		".scrollto",
		function (e) {
			if (select(this.hash)) {
				e.preventDefault();

				let body = select("body");
				if (body.classList.contains("mobile-nav-active")) {
					body.classList.remove("mobile-nav-active");
					let navbarToggle = select(".mobile-nav-toggle");
					navbarToggle.classList.toggle("bi-list");
					navbarToggle.classList.toggle("bi-x");
				}
				scrollto(this.hash);
			}
		},
		true
	);
	/**
	 * Scroll with offset on page load with hash links in the url
	 */
	window.addEventListener("load", () => {
		if (window.location.hash) {
			if (select(window.location.hash)) {
				scrollto(window.location.hash);
			}
		}
	});

	/**
	 * Hero type effect
	 */
	const typed = select(".typed");
	if (typed) {
		let typed_strings = typed.getAttribute("data-typed-items");
		typed_strings = typed_strings.split(",");
		new Typed(".typed", {
			strings: typed_strings,
			loop: true,
			typeSpeed: 100,
			backSpeed: 50,
			backDelay: 1000,
		});
	}

	/**
	 * Skills animation
	 */
	let skillsContent = select(".skills-content");
	if (skillsContent) {
		new Waypoint({
			element: skillsContent,
			offset: "80%",
			handler: function (direction) {
				let progress = select(".progress .progress-bar", true);
				progress.forEach((el) => {
					el.style.width = el.getAttribute("aria-valuenow") + "%";
				});
			},
		});
	}

	
	/**
	 * Animation on scroll
	 */
	window.addEventListener("load", () => {
		AOS.init({
			duration: 1000,
			easing: "ease-in-out",
			once: true,
			mirror: false,
		});
	});

	/**
	 * Initiate Pure Counter
	 */
	new PureCounter();

	/**
	 * End-Hero type effect
	 */
	const type = select(".type");
	if(type){
		let type_strings = type.getAttribute("data-type-items");
		type_strings = type_strings.split(",");
		new Typed(".type", {
			strings: type_strings,
			loop: true,
			typeSpeed: 100,
			backSpeed: 50,
			backDelay: 2000,
		});
	}
})();

$(document).ready(function() {
    $('form').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        $.ajax({
            url: 'contact.php',
            type: 'POST',
            data: {
                name: $('#name').val(),
                email: $('#email').val(),
                subject: $('#subject').val(),
                message: $('#message').val()
            },
            success: function(response) {
                console.log('Form submitted successfully');
            },
            error: function(xhr, status, error) {
                console.error('Form submission failed: ' + error);
            }
        });
    });
});