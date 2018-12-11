/* jshint esversion: 6, browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, document */

// Import dependencies
import lazySizes from 'lazysizes';
import Mailchimp from './mailchimp';
import scrollTo from 'jquery.scrollto';

// Import style
import '../styl/site.styl';

class Site {
  constructor() {
    this.mobileThreshold = 601;

    this.advanceDocumentation = this.advanceDocumentation.bind(this);

    $(window).resize(this.onResize.bind(this));

    $(document).ready(this.onReady.bind(this));
  }

  onResize() {

  }

  onReady() {
    lazySizes.init();



    if ($('body').hasClass('page-home')) {
      this.homeHover();
    }
    if ($('body').hasClass('single')) {
      this.bindDocumentation();
    }
  }

  fixWidows() {
    // utility class mainly for use on headines to avoid widows [single words on a new line]
    $('.js-fix-widows').each(function(){
      var string = $(this).html();
      string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
      $(this).html(string);
    });
  }

  homeHover() {
    $('.home-link').hover(function() {
      $('body.page-home').toggleClass('hover');
    });
  }

  bindDocumentation() {
    if ($('.documentation-item').length) {
      $('.documentation-item img').on('click', this.advanceDocumentation);
    }
  }

  advanceDocumentation(e) {
    let $parent = $(e.target).parent('.documentation-item');

    if ($parent.hasClass('documentation-next')) {
      let $nextItem = $parent.next('.documentation-item');
      let pos = $nextItem.offset().top + ($nextItem.height() / 2) - ($(window).height() / 2);
      $.scrollTo(pos, 500);
    } else if ($parent.hasClass('documentation-top')) {
      let $firstItem = $('.documentation-item').first();
      let pos = $firstItem.offset().top + ($firstItem.height() / 2) - ($(window).height() / 2);
      $.scrollTo(pos, 1000);
    }
  }
}

new Site();
new Mailchimp();
