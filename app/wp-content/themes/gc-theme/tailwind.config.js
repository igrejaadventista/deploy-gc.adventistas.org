module.exports = {
  content: ['./app/**/*.php', './resources/**/*.{php,vue,js}'],
  theme: {
    colors: {
      'transparent': 'transparent',
      'white': '#ffffff',
      'black': '#000000',
      'primary': '#FFBA14',
      'secondary': '#202936',
      'grey': '#545A61',
      'grey-light': '#EAEAEA',
    },
    fontFamily: {
      'sans': ['Noto Sans', 'system-ui'],
    },
    maxWidth: {
      'container': '724px',
    },
    extend: {
      aspectRatio: {
        'thumbnail': '159 / 85',
        'video-lg': '317 / 200',
      },
    },
  },
  plugins: [],
};
