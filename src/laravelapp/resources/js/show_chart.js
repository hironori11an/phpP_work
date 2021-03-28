import 'chart.js';
import 'chartjs-plugin-colorschemes';
import 'chartjs-plugin-datalabels';

window.make_chart = function make_chart(id, labels, data) {
  var ctx = document.getElementById(id).getContext('2d');
  var titleName = '';
  if (id === 'genreChart') {
    titleName = 'ジャンル';
  } else if (id === 'chyshChart') {
    titleName = '著者';
  }
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: labels,
      datasets: [{
        // label: '割合',
        data: data,
        borderWidth: 1
      }]
    },
    options: {
      plugins: {
        colorschemes: {
          // 色の指定しなくても、自動で割り付けてくれる
          scheme: 'brewer.Paired12'
        },
        datalabels: {
          color: '#000',
          font: {
            weight: 'bold',
            size: 20,
          },
        }
      },
      layout: {
        padding: {
          left: 0,
          right: 0,
          top: 0,
          bottom: 0
        }
      },
      title: {
        display: true,
        position: 'bottom',
        fontSize: 15,
        text: titleName
      },
      // 判例
      legend: {
        display: true,
        position: 'right'
      },
      animation: false
    }
  });
};
