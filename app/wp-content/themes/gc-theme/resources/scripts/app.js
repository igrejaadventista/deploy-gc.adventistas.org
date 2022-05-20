import {domReady} from '@roots/sage/client';
import './modules/infinite-scroll';
import Timeline from './modules/timeline';
// import Live from './modules/live';
import './utils/date';

/**
 * app.main
 */
const main = async (err) => {
  if (err) {
    // handle hmr errors
    console.error(err);
  }

  // application code
  // new Live;
  new Timeline;
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);
