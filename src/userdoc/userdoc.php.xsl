<xsl:stylesheet
        version="2.0"
        xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
        xmlns:ctboost="http://yii-booster.clevertech.biz/UserDocumentationSchema">

    <xsl:function name="ctboost:makeSectionId">
        <xsl:param name="sectionName" />
        <xsl:value-of select="replace(normalize-space(replace(lower-case($sectionName), '[^a-zA-Z0-9]', ' ')), ' ', '-')" />
    </xsl:function>
    <xsl:function name="ctboost:makeWidgetCode">
        <xsl:param name="widgetClassName" />
        <xsl:value-of select="replace(lower-case($widgetClassName), '^tb', '')" />
    </xsl:function>

    <xsl:variable name="widgetname" select="documentation/@for" />
    <xsl:variable name="widgetcode" select="ctboost:makeWidgetCode($widgetname)" />

    <xsl:template match="/">
        <xsl:processing-instruction name="php">
            /**
             * End-user documentation for <xsl:value-of select="$widgetname" /> widget.
             * @var WidgetsController $this
             */

            $this->header = '<xsl:value-of select="$widgetname" />';
            $this->subheader = '<xsl:value-of select="documentation/@punchline" />';

            $this->menu = array(
                <xsl:for-each select="//section">
                    <xsl:variable name="sectionid" select="ctboost:makeSectionId(@named)" />
                    '<xsl:value-of select="$sectionid" />' => '<xsl:value-of select="@named" />',
                </xsl:for-each>
            );
        </xsl:processing-instruction>

        <xsl:apply-templates />
    </xsl:template>

    <xsl:template match="section">
        <section>
            <xsl:attribute name="id">
                <xsl:value-of select="ctboost:makeSectionId(@named)" />
            </xsl:attribute>

            <div class="page-header">
                <h1><xsl:value-of select="@named" /></h1>
            </div>

            <xsl:apply-templates />
        </section>

    </xsl:template>

    <xsl:template match="example">
        <xsl:processing-instruction name="php">
            $this->widget('Example', array('name' => '<xsl:value-of select="$widgetcode" />.<xsl:value-of select="@name" />'));
        </xsl:processing-instruction>
    </xsl:template>
</xsl:stylesheet>