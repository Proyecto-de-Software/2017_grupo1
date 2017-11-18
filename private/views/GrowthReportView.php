<?php
abstract class GrowthReportView extends TwigView
{
  public function __construct($chartTitle, $xAxis_title, $yAxis_title)
  {
    $this->chartTitle = $chartTitle;
    $this->xAxis_title = $xAxis_title;
    $this->yAxis_title = $yAxis_title;
  }

  abstract protected function chartData();

  public function show()
  {
    $this->render(
        [
          'chart_title' => $this->chartTitle,
          'xAxis_title' => $this->xAxis_title,
          'yAxis_title' => $this->yAxis_title,
          'chart_data' => $this->chartData()
        ]
      );
  }

  protected function getTemplateFile()
  {
    return 'pacient_growth_report.html';
  }
}

class GrilsWeightGrowthReport extends GrowthReportView
{
  public function __construct()
  {
    parent::__construct('Curva de crecimiento de niñas hasta 13 semanas', 'Edad (en semanas)', 'Peso (kg)');
  }

  protected function chartData()
  {
    return "
    {
      name: '3rd',
      data: [[0, 2.4], [1, 2.5], [2, 2.7], [3, 2.9], [4, 3.1], [5, 3.3], [6, 3.5], [7, 3.7], [8, 3.9], [9, 4.1], [10, 4.2], [11, 4.3], [12, 4.4], [13, 4.5]]
    },
    {
      name: '15th',
      data: [[0, 2.8], [1, 2.9], [2, 3.1], [3, 3.3], [4, 3.5], [5, 3.8], [6, 4.0], [7, 4.2], [8, 4.4], [9, 4.5], [10, 4.7], [11, 4.8], [12, 5.0], [13, 5.1]]
    },
    {
      name: '50th',
      data: [[0, 3.2], [1, 3.3], [2, 3.6], [3, 3.8], [4, 4.1], [5, 4.3], [6, 4.6], [7, 4.8], [8, 5.0], [9, 5.2], [10, 5.4], [11, 5.5], [12, 5.7], [13, 5.8]]
    },
    {
      name: '85th',
      data: [[0, 3.7], [1, 3.9], [2, 4.1], [3, 4.4], [4, 4.7], [5, 5.0], [6, 5.2], [7, 5.5], [8, 5.7], [9, 5.9], [10, 6.1], [11, 6.3], [12, 6.5], [13, 6.6]]
    },
    {
      name: '97th',
      data: [[0, 4.2], [1, 4.4], [2, 4.7], [3, 5.0], [4, 5.4], [5, 5.7], [6, 6.0], [7, 6.2], [8, 6.5], [9, 6.7], [10, 6.9], [11, 7.1], [12, 7.3], [13, 7.5]]
    }";
  }
}

class BoysWeightGrowthReport extends GrowthReportView
{
  public function __construct()
  {
    parent::__construct('Curva de crecimiento de niños hasta 13 semanas', 'Edad (en semanas)', 'Peso (kg)');
  }

  protected function chartData()
  {
    return "
    {
      name: '3rd',
      data: [ [0, 2.5], [1, 2.6], [2, 2.8], [3, 3.1], [4, 3.4], [5, 3.6], [6, 3.8], [7, 4.1], [8, 4.3], [9, 4.4], [10, 4.6], [11, 4.8], [12, 4.9], [13, 5.1] ]
    },
    {
      name: '15th',
      data: [ [0, 2.9], [1, 3.0], [2, 3.2], [3, 3.5], [4, 3.8], [5, 4.1], [6, 4.3], [7, 4.5], [8, 4.7], [9, 4.9], [10, 5.1], [11, 5.3], [12, 5.5], [13, 5.6] ]
    },
    {
      name: '50th',
      data: [ [0, 3.3], [1, 3.5], [2, 3.8], [3, 4.1], [4, 4.4], [5, 4.7], [6, 4.9], [7, 5.2], [8, 5.4], [9, 5.6], [10, 5.8], [11, 6.0], [12, 6.2], [13, 6.4] ]
    },
    {
      name: '85th',
      data: [ [0, 3.7], [1, 3.9], [2, 4.1], [3, 4.4], [4, 4.7], [5, 5.0], [6, 5.2], [7, 5.5], [8, 5.7], [9, 5.9], [10, 6.1], [11, 6.3], [12, 6.5], [13, 6.6] ]
    },
    {
      name: '97th',
      data: [ [0, 4.3], [1, 4.5], [2, 4.9], [3, 5.2], [4, 5.6], [5, 5.9], [6, 6.3], [7, 6.5], [8, 6.8], [9, 7.1], [10, 7.3], [11, 7.5], [12, 7.7], [13, 7.9] ]
    }";
  }
}

class GrilsTallGrowthReport extends GrowthReportView
{
  public function __construct()
  {
    parent::__construct('Curva de talla de niñas hasta 2 años', 'Longitud (cm)', 'Peso (kg)');
  }

  protected function chartData()
  {
    return "
    {
      name: '3rd',
      data: [	[45, 2.1], [45.5, 2.2], [46, 2.2], [46.5, 2.3], [47, 2.4], [47.5, 2.4], [48, 2.5],
        [48.5, 2.6], [49, 2.7], [49.5, 2.8], [50, 2.8], [50.5, 2.9], [51, 3], [51.5, 3.1],
        [52, 3.2], [52.5, 3.3], [53, 3.4], [53.5, 3.5], [54, 3.6], [54.5, 3.7], [55, 3.9],
        [55.5, 4], [56, 4.1], [56.5, 4.2], [57, 4.3], [57.5, 4.4], [58, 4.5], [58.5, 4.6],
        [59, 4.8], [59.5, 4.9], [60, 5], [60.5, 5.1], [61, 5.2], [61.5, 5.3], [62, 5.4],
        [62.5, 5.5], [63, 5.6], [63.5, 5.7], [64, 5.8], [64.5, 5.9], [65, 6], [65.5, 6.1],
        [66, 6.2], [66.5, 6.3], [67, 6.4], [67.5, 6.5], [68, 6.6], [68.5, 6.7], [69, 6.7],
        [69.5, 6.8], [70, 6.9], [70.5, 7], [71, 7.1], [71.5, 7.2], [72, 7.3], [72.5, 7.4],
        [73, 7.4], [73.5, 7.5], [74, 7.6], [74.5, 7.7], [75, 7.8], [75.5, 7.8], [76, 7.9],
        [76.5, 8], [77, 8.1], [77.5, 8.2], [78, 8.2], [78.5, 8.3], [79, 8.4], [79.5, 8.5],
        [80, 8.6], [80.5, 8.7], [81, 8.8], [81.5, 8.8], [82, 8.9], [82.5, 9], [83, 9.1],
        [83.5, 9.2], [84, 9.3], [84.5, 9.4], [85, 9.5], [85.5, 9.6], [86, 9.8], [86.5, 9.9],
        [87, 10], [87.5, 10.1], [88, 10.2], [88.5, 10.3], [89, 10.4], [89.5, 10.5], [90, 10.6],
        [90.5, 10.7], [91, 10.8], [91.5, 10.9], [92, 11], [92.5, 11.1], [93, 11.2], [93.5, 11.3],
        [94, 11.4], [94.5, 11.5], [95, 11.6], [95.5, 11.8], [96, 11.9], [96.5, 12], [97, 12.1],
        [97.5, 12.2], [98, 12.3], [98.5, 12.4], [99, 12.5], [99.5, 12.6], [100, 12.7],
        [100.5, 12.9], [101, 13], [101.5, 13.1], [102, 13.2], [102.5, 13.3], [103, 13.5],
        [103.5, 13.6], [104, 13.7], [104.5, 13.9], [105, 14], [105.5, 14.1], [106, 14.3],
        [106.5, 14.4], [107, 14.5], [107.5, 14.7], [108, 14.8], [108.5, 15], [109, 15.1],
        [109.5, 15.3], [110, 15.4] ]
      },
      {
      name: '15th',
      data: [ [45, 2.2], [45.5, 2.3], [46, 2.4], [46.5, 2.5], [47, 2.6], [47.5, 2.6], [48, 2.7],
        [48.5, 2.8], [49, 2.9], [49.5, 3], [50, 3.1], [50.5, 3.2], [51, 3.2], [51.5, 3.4],
        [52, 3.5], [52.5, 3.6], [53, 3.7], [53.5, 3.8], [54, 3.9], [54.5, 4], [55, 4.1],
        [55.5, 4.3], [56, 4.4], [56.5, 4.5], [57, 4.6], [57.5, 4.8], [58, 4.9], [58.5, 5],
        [59, 5.1], [59.5, 5.2], [60, 5.4], [60.5, 5.5], [61, 5.6], [61.5, 5.7], [62, 5.8],
        [62.5, 5.9], [63, 6], [63.5, 6.1], [64, 6.2], [64.5, 6.3], [65, 6.5], [65.5, 6.6],
        [66, 6.7], [66.5, 6.8], [67, 6.9], [67.5, 7], [68, 7.1], [68.5, 7.2], [69, 7.3],
        [69.5, 7.3], [70, 7.4], [70.5, 7.5], [71, 7.6], [71.5, 7.7], [72, 7.8], [72.5, 7.9],
        [73, 8], [73.5, 8.1], [74, 8.2], [74.5, 8.3], [75, 8.3], [75.5, 8.4], [76, 8.5],
        [76.5, 8.6], [77, 8.7], [77.5, 8.8], [78, 8.9], [78.5, 8.9], [79, 9], [79.5, 9.1],
        [80, 9.2], [80.5, 9.3], [81, 9.4], [81.5, 9.5], [82, 9.6], [82.5, 9.7], [83, 9.8],
        [83.5, 9.9], [84, 10], [84.5, 10.1], [85, 10.2], [85.5, 10.4], [86, 10.5], [86.5, 10.6],
        [87, 10.7], [87.5, 10.8], [88, 10.9], [88.5, 11], [89, 11.2], [89.5, 11.3], [90, 11.4],
        [90.5, 11.5], [91, 11.6], [91.5, 11.7], [92, 11.8], [92.5, 12], [93, 12.1], [93.5, 12.2],
        [94, 12.3], [94.5, 12.4], [95, 12.5], [95.5, 12.6], [96, 12.7], [96.5, 12.9], [97, 13],
        [97.5, 13.1], [98, 13.2], [98.5, 13.3], [99, 13.5], [99.5, 13.6], [100, 13.7],
        [100.5, 13.8], [101, 14], [101.5, 14.1], [102, 14.2], [102.5, 14.4], [103, 14.5],
        [103.5, 14.6], [104, 14.8], [104.5, 14.9], [105, 15.1], [105.5, 15.2], [106, 15.4],
        [106.5, 15.5], [107, 15.7], [107.5, 15.8], [108, 16], [108.5, 16.2], [109, 16.3],
        [109.5, 16.5], [110, 16.7] ]
    },
    {
      name: '50th',
      data: [	[45, 2.5], [45.5, 2.5], [46, 2.6], [46.5, 2.7], [47, 2.8], [47.5, 2.9], [48, 3],
        [48.5, 3.1], [49, 3.2], [49.5, 3.3], [50, 3.4], [50.5, 3.5], [51, 3.6], [51.5, 3.7],
        [52, 3.8], [52.5, 3.9], [53, 4], [53.5, 4.2], [54, 4.3], [54.5, 4.4], [55, 4.5],
        [55.5, 4.7], [56, 4.8], [56.5, 5], [57, 5.1], [57.5, 5.2], [58, 5.4], [58.5, 5.5],
        [59, 5.6], [59.5, 5.7], [60, 5.9], [60.5, 6], [61, 6.1], [61.5, 6.3], [62, 6.4],
        [62.5, 6.5], [63, 6.6], [63.5, 6.7], [64, 6.9], [64.5, 7], [65, 7.1], [65.5, 7.2],
        [66, 7.3], [66.5, 7.4], [67, 7.5], [67.5, 7.6], [68, 7.7], [68.5, 7.9], [69, 8],
        [69.5, 8.1], [70, 8.2], [70.5, 8.3], [71, 8.4], [71.5, 8.5], [72, 8.6], [72.5, 8.7],
        [73, 8.8], [73.5, 8.9], [74, 9], [74.5, 9.1], [75, 9.1], [75.5, 9.2], [76, 9.3], [76.5, 9.4],
        [77, 9.5], [77.5, 9.6], [78, 9.7], [78.5, 9.8], [79, 9.9], [79.5, 10], [80, 10.1],
        [80.5, 10.2], [81, 10.3], [81.5, 10.4], [82, 10.5], [82.5, 10.6], [83, 10.7], [83.5, 10.9],
        [84, 11], [84.5, 11.1], [85, 11.2], [85.5, 11.3], [86, 11.5], [86.5, 11.6], [87, 11.7],
        [87.5, 11.8], [88, 12], [88.5, 12.1], [89, 12.2], [89.5, 12.3], [90, 12.5], [90.5, 12.6],
        [91, 12.7], [91.5, 12.8], [92, 13], [92.5, 13.1], [93, 13.2], [93.5, 13.3], [94, 13.5],
        [94.5, 13.6], [95, 13.7], [95.5, 13.8], [96, 14], [96.5, 14.1], [97, 14.2], [97.5, 14.4],
        [98, 14.5], [98.5, 14.6], [99, 14.8], [99.5, 14.9], [100, 15], [100.5, 15.2], [101, 15.3],
        [101.5, 15.5], [102, 15.6], [102.5, 15.8], [103, 15.9], [103.5, 16.1], [104, 16.2],
        [104.5, 16.4], [105, 16.5], [105.5, 16.7], [106, 16.9], [106.5, 17.1], [107, 17.2],
        [107.5, 17.4], [108, 17.6], [108.5, 17.8], [109, 18], [109.5, 18.1], [110, 18.3] ]
    },
    {
      name: '85th',
      data: [	[45, 2.7], [45.5, 2.8], [46, 2.9], [46.5, 3], [47, 3.1], [47.5, 3.2], [48, 3.3],
        [48.5, 3.4], [49, 3.5], [49.5, 3.6], [50, 3.7], [50.5, 3.8], [51, 3.9], [51.5, 4],
        [52, 4.2], [52.5, 4.3], [53, 4.4], [53.5, 4.6], [54, 4.7], [54.5, 4.9], [55, 5],
        [55.5, 5.2], [56, 5.3], [56.5, 5.5], [57, 5.6], [57.5, 5.7], [58, 5.9], [58.5, 6],
        [59, 6.2], [59.5, 6.3], [60, 6.5], [60.5, 6.6], [61, 6.7], [61.5, 6.9], [62, 7],
        [62.5, 7.2], [63, 7.3], [63.5, 7.4], [64, 7.5], [64.5, 7.7], [65, 7.8], [65.5, 7.9],
        [66, 8], [66.5, 8.2], [67, 8.3], [67.5, 8.4], [68, 8.5], [68.5, 8.6], [69, 8.8], [69.5, 8.9],
        [70, 9], [70.5, 9.1], [71, 9.2], [71.5, 9.3], [72, 9.4], [72.5, 9.5], [73, 9.6], [73.5, 9.7],
        [74, 9.9], [74.5, 10], [75, 10.1], [75.5, 10.2], [76, 10.3], [76.5, 10.4], [77, 10.5],
        [77.5, 10.6], [78, 10.7], [78.5, 10.8], [79, 10.9], [79.5, 11], [80, 11.1], [80.5, 11.2],
        [81, 11.3], [81.5, 11.4], [82, 11.6], [82.5, 11.7], [83, 11.8], [83.5, 11.9], [84, 12.1],
        [84.5, 12.2], [85, 12.3], [85.5, 12.5], [86, 12.6], [86.5, 12.7], [87, 12.9], [87.5, 13],
        [88, 13.2], [88.5, 13.3], [89, 13.4], [89.5, 13.6], [90, 13.7], [90.5, 13.8], [91, 14],
        [91.5, 14.1], [92, 14.2], [92.5, 14.4], [93, 14.5], [93.5, 14.7], [94, 14.8], [94.5, 14.9],
        [95, 15.1], [95.5, 15.2], [96, 15.4], [96.5, 15.5], [97, 15.6], [97.5, 15.8], [98, 15.9],
        [98.5, 16.1], [99, 16.2], [99.5, 16.4], [100, 16.5], [100.5, 16.7], [101, 16.9], [101.5, 17],
        [102, 17.2], [102.5, 17.4], [103, 17.5], [103.5, 17.7], [104, 17.9], [104.5, 18.1], [105, 18.2],
        [105.5, 18.4], [106, 18.6], [106.5, 18.8], [107, 19], [107.5, 19.2], [108, 19.4], [108.5, 19.6],
        [109, 19.8], [109.5, 20], [110, 20.2] ]
    },
    {
      name: '97th',
      data: [	[45, 2.9], [45.5, 3], [46, 3.1], [46.5, 3.2], [47, 3.3], [47.5, 3.4], [48, 3.5], [48.5, 3.7],
        [49, 3.8], [49.5, 3.9], [50, 4], [50.5, 4.1], [51, 4.3], [51.5, 4.4], [52, 4.5], [52.5, 4.7],
        [53, 4.8], [53.5, 5], [54, 5.1], [54.5, 5.3], [55, 5.4], [55.5, 5.6], [56, 5.8], [56.5, 5.9],
        [57, 6.1], [57.5, 6.2], [58, 6.4], [58.5, 6.5], [59, 6.7], [59.5, 6.9], [60, 7], [60.5, 7.2],
        [61, 7.3], [61.5, 7.5], [62, 7.6], [62.5, 7.8], [63, 7.9], [63.5, 8], [64, 8.2], [64.5, 8.3],
        [65, 8.5], [65.5, 8.6], [66, 8.7], [66.5, 8.9], [67, 9], [67.5, 9.1], [68, 9.2], [68.5, 9.4],
        [69, 9.5], [69.5, 9.6], [70, 9.7], [70.5, 9.9], [71, 10], [71.5, 10.1], [72, 10.2], [72.5, 10.3],
        [73, 10.4], [73.5, 10.6], [74, 10.7], [74.5, 10.8], [75, 10.9], [75.5, 11], [76, 11.1], [76.5, 11.2],
        [77, 11.3], [77.5, 11.4], [78, 11.5], [78.5, 11.7], [79, 11.8], [79.5, 11.9], [80, 12], [80.5, 12.1],
        [81, 12.2], [81.5, 12.4], [82, 12.5], [82.5, 12.6], [83, 12.8], [83.5, 12.9], [84, 13.1],
        [84.5, 13.2], [85, 13.3], [85.5, 13.5], [86, 13.6], [86.5, 13.8], [87, 13.9], [87.5, 14.1], [88, 14.2],
        [88.5, 14.4], [89, 14.5], [89.5, 14.7], [90, 14.8], [90.5, 15], [91, 15.1], [91.5, 15.3], [92, 15.4],
        [92.5, 15.6], [93, 15.7], [93.5, 15.9], [94, 16], [94.5, 16.2], [95, 16.3], [95.5, 16.5], [96, 16.6],
        [96.5, 16.8], [97, 16.9], [97.5, 17.1], [98, 17.3], [98.5, 17.4], [99, 17.6], [99.5, 17.8], [100, 17.9],
        [100.5, 18.1], [101, 18.3], [101.5, 18.5], [102, 18.6], [102.5, 18.8], [103, 19], [103.5, 19.2],
        [104, 19.4], [104.5, 19.6], [105, 19.8], [105.5, 20], [106, 20.2], [106.5, 20.4], [107, 20.6],
        [107.5, 20.9], [108, 21.1], [108.5, 21.3], [109, 21.5], [109.5, 21.8], [110, 22] ]
    }";
  }
}

class BoysTallGrowthReport extends GrowthReportView
{
  public function __construct()
  {
    parent::__construct('Curva de talla de niños hasta 2 años', 'Longitud (cm)', 'Peso (kg)');
  }

  protected function chartData()
  {
    return "
    {
      name: '3rd',
      data: [	[45, 2.1], [45.5, 2.1], [46, 2.2], [46.5, 2.3], [47, 2.4], [47.5, 2.4], [48, 2.5],
          [48.5, 2.6], [49, 2.7], [49.5, 2.7], [50, 2.8], [50.5, 2.9], [51, 3], [51.5, 3.1],
          [52, 3.2], [52.5, 3.3], [53, 3.4], [53.5, 3.5], [54, 3.6], [54.5, 3.8], [55, 3.9],
          [55.5, 4], [56, 4.1], [56.5, 4.3], [57, 4.4], [57.5, 4.5], [58, 4.6], [58.5, 4.8],
          [59, 4.9], [59.5, 5], [60, 5.1], [60.5, 5.3], [61, 5.4], [61.5, 5.5], [62, 5.6],
          [62.5, 5.7], [63, 5.8], [63.5, 5.9], [64, 6], [64.5, 6.1], [65, 6.3], [65.5, 6.4],
          [66, 6.5], [66.5, 6.6], [67, 6.7], [67.5, 6.8], [68, 6.9], [68.5, 7], [69, 7.1],
          [69.5, 7.1], [70, 7.2], [70.5, 7.3], [71, 7.4], [71.5, 7.5], [72, 7.6], [72.5, 7.7],
          [73, 7.8], [73.5, 7.9], [74, 8], [74.5, 8.1], [75, 8.2], [75.5, 8.2], [76, 8.3],
          [76.5, 8.4], [77, 8.5], [77.5, 8.6], [78, 8.7], [78.5, 8.7], [79, 8.8], [79.5, 8.9],
          [80, 9], [80.5, 9.1], [81, 9.1], [81.5, 9.2], [82, 9.3], [82.5, 9.4], [83, 9.5],
          [83.5, 9.6], [84, 9.7], [84.5, 9.8], [85, 9.9], [85.5, 10], [86, 10.1], [86.5, 10.2],
          [87, 10.3], [87.5, 10.4], [88, 10.6], [88.5, 10.7], [89, 10.8], [89.5, 10.9], [90, 11],
          [90.5, 11.1], [91, 11.2], [91.5, 11.3], [92, 11.4], [92.5, 11.5], [93, 11.6], [93.5, 11.7],
          [94, 11.8], [94.5, 11.9], [95, 12], [95.5, 12.1], [96, 12.2], [96.5, 12.3], [97, 12.4],
          [97.5, 12.5], [98, 12.6], [98.5, 12.7], [99, 12.8], [99.5, 12.9], [100, 13], [100.5, 13.2],
          [101, 13.3], [101.5, 13.4], [102, 13.5], [102.5, 13.6], [103, 13.8], [103.5, 13.9], [104, 14],
          [104.5, 14.1], [105, 14.2], [105.5, 14.4], [106, 14.5], [106.5, 14.6], [107, 14.8],
          [107.5, 14.9], [108, 15], [108.5, 15.2], [109, 15.3], [109.5, 15.4], [110, 15.6] ]
    },
    {
      name: '15th',
      data: [ [45, 2.2], [45.5, 2.3], [46, 2.4], [46.5, 2.5], [47, 2.5], [47.5, 2.6], [48, 2.7],
          [48.5, 2.8], [49, 2.9], [49.5, 2.9], [50, 3], [50.5, 3.1], [51, 3.2], [51.5, 3.3],
          [52, 3.4], [52.5, 3.6], [53, 3.7], [53.5, 3.8], [54, 3.9], [54.5, 4], [55, 4.2], [55.5, 4.3],
          [56, 4.4], [56.5, 4.6], [57, 4.7], [57.5, 4.8], [58, 5], [58.5, 5.1], [59, 5.2], [59.5, 5.4],
          [60, 5.5], [60.5, 5.6], [61, 5.8], [61.5, 5.9], [62, 6], [62.5, 6.1], [63, 6.2], [63.5, 6.3],
          [64, 6.5], [64.5, 6.6], [65, 6.7], [65.5, 6.8], [66, 6.9], [66.5, 7], [67, 7.1], [67.5, 7.2],
          [68, 7.3], [68.5, 7.4], [69, 7.5], [69.5, 7.6], [70, 7.7], [70.5, 7.8], [71, 8], [71.5, 8.1],
          [72, 8.2], [72.5, 8.3], [73, 8.4], [73.5, 8.4], [74, 8.5], [74.5, 8.6], [75, 8.7], [75.5, 8.8],
          [76, 8.9], [76.5, 9], [77, 9.1], [77.5, 9.2], [78, 9.3], [78.5, 9.3], [79, 9.4], [79.5, 9.5],
          [80, 9.6], [80.5, 9.7], [81, 9.8], [81.5, 9.9], [82, 10], [82.5, 10.1], [83, 10.1], [83.5, 10.3],
          [84, 10.4], [84.5, 10.5], [85, 10.6], [85.5, 10.7], [86, 10.8], [86.5, 10.9], [87, 11],
          [87.5, 11.2], [88, 11.3], [88.5, 11.4], [89, 11.5], [89.5, 11.6], [90, 11.7], [90.5, 11.8],
          [91, 11.9], [91.5, 12], [92, 12.2], [92.5, 12.3], [93, 12.4], [93.5, 12.5], [94, 12.6],
          [94.5, 12.7], [95, 12.8], [95.5, 12.9], [96, 13], [96.5, 13.1], [97, 13.2], [97.5, 13.4],
          [98, 13.5], [98.5, 13.6], [99, 13.7], [99.5, 13.8], [100, 13.9], [100.5, 14.1], [101, 14.2],
          [101.5, 14.3], [102, 14.5], [102.5, 14.6], [103, 14.7], [103.5, 14.8], [104, 15], [104.5, 15.1],
          [105, 15.3], [105.5, 15.4], [106, 15.5], [106.5, 15.7], [107, 15.8], [107.5, 16], [108, 16.1],
          [108.5, 16.3], [109, 16.4], [109.5, 16.6], [110, 16.7] ]
    },
    {
      name: '50th',
      data: [	[45, 2.4], [45.5, 2.5], [46, 2.6], [46.5, 2.7], [47, 2.8], [47.5, 2.9], [48, 2.9], [48.5, 3],
          [49, 3.1], [49.5, 3.2], [50, 3.3], [50.5, 3.4], [51, 3.5], [51.5, 3.6], [52, 3.8], [52.5, 3.9],
          [53, 4], [53.5, 4.1], [54, 4.3], [54.5, 4.4], [55, 4.5], [55.5, 4.7], [56, 4.8], [56.5, 5],
          [57, 5.1], [57.5, 5.3], [58, 5.4], [58.5, 5.6], [59, 5.7], [59.5, 5.9], [60, 6], [60.5, 6.1],
          [61, 6.3], [61.5, 6.4], [62, 6.5], [62.5, 6.7], [63, 6.8], [63.5, 6.9], [64, 7], [64.5, 7.1],
          [65, 7.3], [65.5, 7.4], [66, 7.5], [66.5, 7.6], [67, 7.7], [67.5, 7.9], [68, 8], [68.5, 8.1],
          [69, 8.2], [69.5, 8.3], [70, 8.4], [70.5, 8.5], [71, 8.6], [71.5, 8.8], [72, 8.9], [72.5, 9],
          [73, 9.1], [73.5, 9.2], [74, 9.3], [74.5, 9.4], [75, 9.5], [75.5, 9.6], [76, 9.7], [76.5, 9.8],
          [77, 9.9], [77.5, 10], [78, 10.1], [78.5, 10.2], [79, 10.3], [79.5, 10.4], [80, 10.4], [80.5, 10.5],
          [81, 10.6], [81.5, 10.7], [82, 10.8], [82.5, 10.9], [83, 11], [83.5, 11.2], [84, 11.3], [84.5, 11.4],
          [85, 11.5], [85.5, 11.6], [86, 11.7], [86.5, 11.9], [87, 12], [87.5, 12.1], [88, 12.2], [88.5, 12.4],
          [89, 12.5], [89.5, 12.6], [90, 12.7], [90.5, 12.8], [91, 13], [91.5, 13.1], [92, 13.2], [92.5, 13.3],
          [93, 13.4], [93.5, 13.5], [94, 13.7], [94.5, 13.8], [95, 13.9], [95.5, 14], [96, 14.1], [96.5, 14.3],
          [97, 14.4], [97.5, 14.5], [98, 14.6], [98.5, 14.8], [99, 14.9], [99.5, 15], [100, 15.2], [100.5, 15.3],
          [101, 15.4], [101.5, 15.6], [102, 15.7], [102.5, 15.9], [103, 16], [103.5, 16.2], [104, 16.3],
          [104.5, 16.5], [105, 16.6], [105.5, 16.8], [106, 16.9], [106.5, 17.1], [107, 17.3], [107.5, 17.4],
          [108, 17.6], [108.5, 17.8], [109, 17.9], [109.5, 18.1], [110, 18.3] ]
    },
    {
      name: '85th',
      data: [	[45, 2.7], [45.5, 2.8], [46, 2.9], [46.5, 3], [47, 3.1], [47.5, 3.1], [48, 3.2], [48.5, 3.3], [49, 3.4],
          [49.5, 3.5], [50, 3.7], [50.5, 3.8], [51, 3.9], [51.5, 4], [52, 4.1], [52.5, 4.3], [53, 4.4], [53.5, 4.5],
          [54, 4.7], [54.5, 4.8], [55, 5], [55.5, 5.1], [56, 5.3], [56.5, 5.4], [57, 5.6], [57.5, 5.8], [58, 5.9],
          [58.5, 6.1], [59, 6.2], [59.5, 6.4], [60, 6.5], [60.5, 6.7], [61, 6.8], [61.5, 7], [62, 7.1], [62.5, 7.3],
          [63, 7.4], [63.5, 7.5], [64, 7.7], [64.5, 7.8], [65, 7.9], [65.5, 8.1], [66, 8.2], [66.5, 8.3], [67, 8.4],
          [67.5, 8.6], [68, 8.7], [68.5, 8.8], [69, 8.9], [69.5, 9.1], [70, 9.2], [70.5, 9.3], [71, 9.4], [71.5, 9.6],
          [72, 9.7], [72.5, 9.8], [73, 9.9], [73.5, 10], [74, 10.1], [74.5, 10.3], [75, 10.4], [75.5, 10.5],
          [76, 10.6], [76.5, 10.7], [77, 10.8], [77.5, 10.9], [78, 11], [78.5, 11.1], [79, 11.2], [79.5, 11.3],
          [80, 11.4], [80.5, 11.5], [81, 11.6], [81.5, 11.7], [82, 11.8], [82.5, 11.9], [83, 12], [83.5, 12.2],
          [84, 12.3], [84.5, 12.4], [85, 12.5], [85.5, 12.7], [86, 12.8], [86.5, 12.9], [87, 13.1], [87.5, 13.2],
          [88, 13.3], [88.5, 13.5], [89, 13.6], [89.5, 13.7], [90, 13.8], [90.5, 14], [91, 14.1], [91.5, 14.2],
          [92, 14.4], [92.5, 14.5], [93, 14.6], [93.5, 14.7], [94, 14.9], [94.5, 15], [95, 15.1], [95.5, 15.3],
          [96, 15.4], [96.5, 15.5], [97, 15.7], [97.5, 15.8], [98, 15.9], [98.5, 16.1], [99, 16.2], [99.5, 16.4],
          [100, 16.5], [100.5, 16.7], [101, 16.8], [101.5, 17], [102, 17.2], [102.5, 17.3], [103, 17.5], [103.5, 17.7],
          [104, 17.8], [104.5, 18], [105, 18.2], [105.5, 18.4], [106, 18.5], [106.5, 18.7], [107, 18.9], [107.5, 19.1],
          [108, 19.3], [108.5, 19.5], [109, 19.6], [109.5, 19.8], [110, 20] ]
    },
    {
      name: '97th',
      data: [	[45, 2.9], [45.5, 3], [46, 3.1], [46.5, 3.2], [47, 3.3], [47.5, 3.4], [48, 3.5], [48.5, 3.6], [49, 3.7],
          [49.5, 3.8], [50, 4], [50.5, 4.1], [51, 4.2], [51.5, 4.3], [52, 4.5], [52.5, 4.6], [53, 4.7], [53.5, 4.9],
          [54, 5], [54.5, 5.2], [55, 5.4], [55.5, 5.5], [56, 5.7], [56.5, 5.9], [57, 6], [57.5, 6.2], [58, 6.4],
          [58.5, 6.5], [59, 6.7], [59.5, 6.9], [60, 7], [60.5, 7.2], [61, 7.4], [61.5, 7.5], [62, 7.7], [62.5, 7.8],
          [63, 8], [63.5, 8.1], [64, 8.2], [64.5, 8.4], [65, 8.5], [65.5, 8.7], [66, 8.8], [66.5, 8.9], [67, 9.1],
          [67.5, 9.2], [68, 9.3], [68.5, 9.5], [69, 9.6], [69.5, 9.7], [70, 9.9], [70.5, 10], [71, 10.1], [71.5, 10.3],
          [72, 10.4], [72.5, 10.5], [73, 10.7], [73.5, 10.8], [74, 10.9], [74.5, 11], [75, 11.2], [75.5, 11.3],
          [76, 11.4], [76.5, 11.5], [77, 11.6], [77.5, 11.7], [78, 11.8], [78.5, 12], [79, 12.1], [79.5, 12.2],
          [80, 12.3], [80.5, 12.4], [81, 12.5], [81.5, 12.6], [82, 12.7], [82.5, 12.8], [83, 13], [83.5, 13.1],
          [84, 13.2], [84.5, 13.3], [85, 13.5], [85.5, 13.6], [86, 13.7], [86.5, 13.9], [87, 14], [87.5, 14.2],
          [88, 14.3], [88.5, 14.4], [89, 14.6], [89.5, 14.7], [90, 14.9], [90.5, 15], [91, 15.1], [91.5, 15.3],
          [92, 15.4], [92.5, 15.5], [93, 15.7], [93.5, 15.8], [94, 16], [94.5, 16.1], [95, 16.2], [95.5, 16.4],
          [96, 16.5], [96.5, 16.7], [97, 16.8], [97.5, 17], [98, 17.1], [98.5, 17.3], [99, 17.4], [99.5, 17.6],
          [100, 17.8], [100.5, 17.9], [101, 18.1], [101.5, 18.3], [102, 18.5], [102.5, 18.6], [103, 18.8], [103.5, 19],
          [104, 19.2], [104.5, 19.4], [105, 19.6], [105.5, 19.8], [106, 20], [106.5, 20.2], [107, 20.4], [107.5, 20.6],
          [108, 20.8], [108.5, 21], [109, 21.2], [109.5, 21.4], [110, 21.6] ]
      }";
  }
}

class GirlsPPCGrowthReport extends GrowthReportView
{
  public function __construct()
  {
    parent::__construct('Curva de percentil perímetro cefálico niñas hasta 13 semanas', 'Edad (en semanas)', 'Circunferencia cefálica (cm)');
  }

  protected function chartData()
  {
    return "
    {
      name: '3rd',
      data: [[0, 31.7], [1, 32.4], [2, 33.1], [3, 33.7], [4, 34.2], [5, 34.6], [6, 35], [7, 35.4], [8, 35.7], [9, 36.1], [10, 36.4], [11, 36.7], [12, 36.9], [13, 37.2]]
    },
    {
      name: '15th',
      data: [[0, 32.7], [1, 33.3], [2, 34], [3, 34.6], [4, 35.2], [5, 35.6], [6, 36], [7, 36.4], [8, 36.8], [9, 37.1], [10, 37.4], [11, 37.7], [12, 38], [13, 38.2]]
    },
    {
      name: '50th',
      data: [[0, 33.9], [1, 34.6], [2, 35.2], [3, 35.8], [4, 36.4], [5, 36.8], [6, 37.3], [7, 37.7], [8, 38], [9, 38.4], [10, 38.7], [11, 39], [12, 39.3], [13, 39.5]]
    },
    {
      name: '85th',
      data: [[0, 35.1], [1, 35.8], [2, 36.4], [3, 37], [4, 37.6], [5, 38.1], [6, 38.5], [7, 38.9], [8, 39.3], [9, 39.6], [10, 39.9], [11, 40.2], [12, 40.5], [13, 40.8]]
    },
    {
      name: '97th',
      data: [[0, 36.1], [1, 36.7], [2, 37.4], [3, 38], [4, 38.6], [5, 39.1], [6, 39.5], [7, 39.9], [8, 40.3], [9, 40.6], [10, 41], [11, 41.3], [12, 41.6], [13, 41.9]]
    }";
  }
}

class BoysPPCGrowthReport extends GrowthReportView
{
  public function __construct()
  {
    parent::__construct('Curva de percentil perímetro cefálico niños hasta 13 semanas', 'Edad (en semanas)', 'Circunferencia cefálica (cm)');
  }

  protected function chartData()
  {
    return "
    {
      name: '3rd',
      data: [[0, 32.1], [1, 32.9], [2, 33.7], [3, 34.3], [4, 34.9], [5, 35.4], [6, 35.9], [7, 36.3],
      [8, 36.7], [9, 37], [10, 37.4], [11, 37.7], [12, 38], [13, 38.3]]
    },
    {
      name: '15th',
      data: [[0, 33.1], [1, 33.9], [2, 34.7], [3, 35.3], [4, 35.9], [5, 36.4], [6, 36.8], [7, 37.3],
      [8, 37.7], [9, 38], [10, 38.4], [11, 38.7], [12, 39], [13, 39.3]]
    },
    {
      name: '50th',
      data: [[0, 34.5], [1, 35.2], [2, 35.9], [3, 36.5], [4, 37.1], [5, 37.6], [6, 38.1], [7, 38.5],
      [8, 38.9], [9, 39.2], [10, 39.6], [11, 39.9], [12, 40.2], [13, 40.5]]
    },
    {
      name: '85th',
      data: [[0, 35.8], [1, 36.4], [2, 37.1], [3, 37.7], [4, 38.3], [5, 38.8], [6, 39.3], [7, 39.7],
      [8, 40.1], [9, 40.5], [10, 40.8], [11, 41.1], [12, 41.4], [13, 41.7]]
    },
    {
      name: '97th',
      data: [[0, 36.9], [1, 37.5], [2, 38.1], [3, 38.7], [4, 39.3], [5, 39.8], [6, 40.3], [7, 40.7],
      [8, 41.1], [9, 41.4], [10, 41.8], [11, 42.1], [12, 42.4], [13, 42.7]]
    }";
  }
}
