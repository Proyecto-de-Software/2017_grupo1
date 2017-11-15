<?php
class DemographicDataReportView extends TwigView
{
  public function __construct($chartTitle, $chartCategories, $chartData)
  {
    $this->chartTitle = $chartTitle;
    $this->chartCategories = $chartCategories;
    $this->chartData = $chartData;
  }

  public function show()
  {
    $this->render(
        [
          'chart_title' => $this->chartTitle,
          'chart_categories' => $this->chartCategories,
          'chart_data' => $this->chartData
        ]
      );
  }

  protected function getTemplateFile()
  {
    return 'demographic_data_report.html';
  }
}
