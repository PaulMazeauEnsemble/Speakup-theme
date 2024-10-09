module.exports = {
  content: [
    './*.php',
    './**/*.php',
    './src/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        'black-bg': '#1D1D1D',
        'dimgray': '#696969',
      },
      fontFamily: {
        "Instrument": ['Instrument Serif', 'serif'],
        "DM": ['DM Mono', 'sans-serif'],
      }
    },
  },
  plugins: [],
};
