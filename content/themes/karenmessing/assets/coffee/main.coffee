# Require.js configuration.
require.config
  appDir: './'
  paths:
    'jquery': 'libs/jquery'
  shim: {}

# Main application module.
define [
  'jquery'
], ($) ->
  console.log 'it works'
    
  rand = (min, max) ->
    if arguments.length is 1
      max = min
      min = 0
      
    return Math.floor(Math.random() * max) + min
  
  if window.location.pathname is '/'
    $custom = $ '.custom-category-css'
    $blocks = $ '.work-categories li'
    max = 35
    
    generateCSS = (randX, randY, deg) ->
      "-webkit-transform: translateX(#{randX}px) translateY(#{randY}px) rotate(#{deg}deg);"
    
    $blocks.each (index, block) ->
      slides = ''
      customCSS = ''
      
      for index in [1..4]
        if index % 2 is 0 then max = max * -1
        
        normalCss = ".grid-block.#{block.className.replace 'grid-block ', ''} .index-#{index} {"
        hoverCss = ".grid-block.#{block.className.replace 'grid-block ', ''}:hover .index-#{index} {"
        
        cls = "class='shade index-#{index}'"
          
        result = switch index
          when 1 then [rand(-50, -80), rand(-50, -80), rand(max)]
          when 2 then [rand(50, 80), rand(-50, -80), rand(max)]
          when 3 then [rand(-50, -80), rand(50, 80), rand(max)]
          when 4 then [rand(50, 80), rand(50, 80), rand(max)]
        
        normalCss += "width: #{rand(150, 300)}px; height: #{rand(150, 300)}px; -webkit-transform: rotate(#{rand(max)}deg);} "
        hoverCss += "#{generateCSS.apply this, result}} "
        customCSS += normalCss + hoverCss
        
        slides += "<div #{cls}></div>"
        
        
      $custom.append customCSS
      $(block).append slides

