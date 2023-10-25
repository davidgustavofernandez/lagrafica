/**
 * Mask Image v1.01.02
 * Copyright 2023-2025 David Gustavo Fernandez (https://www.linkedin.com/in/david-gustavo-fernandez-7bb4a028/)
 * Written for Developers Build ASAP
 * Licensed under MIT (http://opensource.org/licenses/MIT)
 */
;(function ($) {
  var _debug = false;

  $.fn.mask_image = function (opt) {
    
    var settings = $.extend({
      responsive: true,
      height: 900
    }, opt );

    if (this.length === 0) {
      return this;
    }

    // support multiple elements
    if (this.length > 1) {
      this.each(function () {
        $(this).mask_image(opt);
      });
      return this;
    }

    // create a namespace to be used throughout the plugin
    var mask_image = {};
    // set a reference to our mask_image element
    var maskimage = this;

    // get the original window dimens (thanks a lot IE)
    (windowWidth = $(window).width()), (windowHeight = $(window).height());

    // Return if hero is already initialized
    if ($(maskimage).data("mask_image")) {
      return;
    }

    // PRIVATE FUNCTIONS
    var inits = function () {
      
      if (_debug) {
        console.log("Init Mask Image");
        console.log(
          "Viewport:" + "W: " + windowWidth + " | H: " + windowHeight
        );
      }

      // Return if hero is already initialized
      if ($(maskimage).data("mask_image")) {
        return;
      }

      mask_image.working = false;
      mask_image.settings = settings;

      if (_debug) {
        console.log("mask_image.settings:", mask_image.settings);
      }

      var thumb = $(maskimage.selector + ' .scroller .detail .caption .content .thumb');
      var detail = $(maskimage.selector + ' .image .detail');
      var img = $(maskimage.selector + ' .image .detail img');
      var box = $(maskimage.selector + ' .scroller .detail .box');
      var box_top = $(maskimage.selector + ' .scroller .detail .box_top');
      var box_bottom = $(maskimage.selector + ' .scroller .detail .box_bottom');

      var mask_image_height = maskimage.height();
      var thumb_height = thumb.height();
      var img_height = img.height();
      var thumb_position = thumb.offsetParent().position();
      var ratio_relation = img_height / thumb_height;
      var size_area_thumb = mask_image_height / ratio_relation;

      // Initial heights
      box.height(size_area_thumb - 1);
      box_top.height(0);
      box_bottom.height(thumb_height - size_area_thumb);

      // Initial positions
      box_bottom.css("margin-top", +(size_area_thumb) + "px");
      // console.log('ok1');

      // console.log('------------------------------------------------');
      // console.log('thumb_position.top', thumb_position.top);
      // console.log('size_area_thumb', size_area_thumb);
      // console.log('thumb_height', thumb_height);
      // console.log((thumb_position.top + (size_area_thumb / 2) - 1));
      // console.log((thumb_height + thumb_position.top - (size_area_thumb / 2) - 1));

      thumb.mousemove(function (ee) {
        if (ee.pageY > (thumb_position.top + (size_area_thumb / 2) - 1) && ee.pageY < (thumb_height + thumb_position.top - (size_area_thumb / 2) - 1)) {
          box_top.css("margin-top", -(size_area_thumb / 2) + "px");
          box_top.height(ee.pageY - thumb_position.top);
          box.css("margin-top", -(thumb_position.top - ee.pageY) - (size_area_thumb / 2) + "px");
          box_bottom.css("margin-top", ee.pageY - (thumb_position.top - (size_area_thumb / 2)) + "px");
          box_bottom.height(thumb_position.top + (thumb_height) - ee.pageY);
          var height_apply = (thumb_position.top - ee.pageY + (size_area_thumb / 2)) * ratio_relation;
          detail.css("margin-top", height_apply + "px");
        }
      });
      
      // bind the resize call to the window
      // if (mask_image.settings.responsive) {
      //   $(window).bind("resize", resizeWindow(maskimage, mask_image));
      // }
      

    };

    /**
     * Update all dynamic mask_image elements
     */
    maskimage.redrawmask = function (mask_image) {
      // resize all
      if (_debug) {
        console.log("Resize");
      }
      // this.init();
    };

    /**
     * Window resize event callback
     */
    // var resizeWindow = function (maskimage, mask_image) {
    //   console.log('resizeWindow');
    //   // Delay if mask_image working.
    //   if (mask_image.working) {
    //     window.setTimeout(resizeWindow(maskimage, mask_image), 10);
    //   } else {
    //     // get the new window dimens (again, thank you IE)
    //     var windowWidthNew = $(window).width(), windowHeightNew = $(window).height();
    //     // make sure that it is a true window resize
    //     // *we must check this because our dinosaur friend IE fires a window resize event when certain DOM elements
    //     // are resized. Can you just die already?*
    //     if ( windowWidth !== windowWidthNew || windowHeight !== windowHeightNew ) {
    //       // set the new window dimens
    //       windowWidth = windowWidthNew;
    //       windowHeight = windowHeightNew;
    //       // update all dynamic elements
    //       maskimage.redrawmask(mask_image);
    //     }
    //   }
    // };

    inits();

    // returns the current jQuery object
    return this;
  };
})(jQuery);
